<?php

namespace App\Http\Controllers\Student;

use App\Models\Course;
use App\Models\Payment;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Services\MidtransService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    /**
     * Show payment form for a course
     */
    public function show(Course $course)
    {
        $user = Auth::user();
        
        // Load course relationships
        $course->load([
            'instructor',
            'category', 
            'courseLevel',
            'topics' => function($query) {
                $query->orderBy('order');
            },
            'contents'
        ]);
        
        
        // Check if user is already enrolled
        $enrollment = Enrollment::where('user_id', $user->id)
                               ->where('course_id', $course->id)
                               ->first();

        if ($enrollment) {
            return redirect()->route('student.courses.learn', $course)
                           ->with('info', 'Anda sudah terdaftar di kursus ini.');
        }

        // Check if course is free
        if ($course->price == 0) {
            return $this->enrollFreeCourse($course);
        }

        // Check if there's a pending payment
        $pendingPayment = Payment::where('user_id', $user->id)
                                ->where('course_id', $course->id)
                                ->where('status', 'pending')
                                ->first();

        return view('student.payment.show', compact('course', 'pendingPayment'));
    }

    /**
     * Create payment for a course
     */
    public function create(Request $request, Course $course)
    {
        Log::info('Payment create method called for course: ' . $course->id);
        $user = Auth::user();

        // Check if user is already enrolled
        $enrollment = Enrollment::where('user_id', $user->id)
                               ->where('course_id', $course->id)
                               ->first();

        if ($enrollment) {
            return redirect()->route('student.courses.learn', $course)
                           ->with('info', 'Anda sudah terdaftar di kursus ini.');
        }

        // Check if course is free
        if ($course->price == 0) {
            return $this->enrollFreeCourse($course);
        }

        // Check if there's already a pending payment
        $existingPayment = Payment::where('user_id', $user->id)
                                 ->where('course_id', $course->id)
                                 ->where('status', 'pending')
                                 ->first();

        if ($existingPayment) {
            // Check if payment is older than 24 hours (expired)
            $isExpired = $existingPayment->created_at->diffInHours(now()) > 24;
            
            if ($isExpired) {
                // Mark old payment as expired and create new one
                $existingPayment->update(['status' => 'failed']);
                Log::info("Expired payment {$existingPayment->transaction_id} marked as failed");
            } else {
                // Redirect to existing payment
                return redirect()->route('student.payment.show', $course)
                               ->with('info', 'Anda sudah memiliki pembayaran yang pending untuk kursus ini.');
            }
        }

        try {
            DB::beginTransaction();

            // Create payment record
            $payment = Payment::create([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'amount' => $course->price,
                'status' => 'pending',
                'transaction_id' => $this->midtransService->generateTransactionId(),
            ]);

            // Load course relationships for payment
            $course->load(['instructor', 'category', 'courseLevel']);

            // Generate snap token
            $snapToken = $this->midtransService->createPayment($payment, $user, $course);

            DB::commit();

            return view('student.payment.pay', compact('course', 'payment', 'snapToken'));

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment creation failed: ' . $e->getMessage());
            return redirect()->back()
                           ->with('error', 'Gagal membuat pembayaran: ' . $e->getMessage());
        }
    }

    /**
     * Handle payment success
     */
    public function success(Request $request)
    {
        $transactionId = $request->get('order_id');
        
        if (!$transactionId) {
            return redirect()->route('welcome')
                           ->with('error', 'Transaction ID tidak ditemukan.');
        }

        $payment = Payment::where('transaction_id', $transactionId)->first();
        
        if (!$payment) {
            return redirect()->route('welcome')
                           ->with('error', 'Pembayaran tidak ditemukan.');
        }

        // Check payment status with Midtrans
        try {
            $status = $this->midtransService->checkPaymentStatus($transactionId);
            
            if ($status['transaction_status'] === 'settlement') {
                $payment->update(['status' => 'completed']);
                $this->midtransService->createEnrollment($payment);
                
                // Check if user is authenticated
                if (auth()->check()) {
                    return redirect()->route('student.courses.learn', $payment->course)
                                   ->with('success', 'Pembayaran berhasil! Selamat belajar!');
                } else {
                    return view('payments.success', ['payment' => $payment]);
                }
            } elseif ($status['transaction_status'] === 'pending') {
                $payment->update(['status' => 'pending']);
                
                // Check if user is authenticated
                if (auth()->check()) {
                    return redirect()->route('student.payment.show', $payment->course)
                                   ->with('info', 'Pembayaran sedang diproses. Silakan tunggu konfirmasi.');
                } else {
                    return view('payments.success', ['payment' => $payment, 'status' => 'pending']);
                }
            } else {
                $payment->update(['status' => 'failed']);
                
                // Check if user is authenticated
                if (auth()->check()) {
                    return redirect()->route('student.payment.show', $payment->course)
                                   ->with('error', 'Pembayaran gagal. Silakan coba lagi.');
                } else {
                    return view('payments.failure', ['payment' => $payment]);
                }
            }
        } catch (\Exception $e) {
            Log::error('Payment status check failed: ' . $e->getMessage());
            
            // Check if payment is completed
            if ($payment->status === 'completed') {
                if (auth()->check()) {
                    return redirect()->route('student.courses.learn', $payment->course)
                                   ->with('success', 'Pembayaran berhasil! Selamat belajar!');
                } else {
                    return view('payments.success', ['payment' => $payment]);
                }
            }

            // Check if user is authenticated
            if (auth()->check()) {
                return redirect()->route('student.payment.show', $payment->course)
                               ->with('info', 'Pembayaran sedang diproses. Silakan tunggu konfirmasi.');
            } else {
                return view('payments.success', ['payment' => $payment, 'status' => 'pending']);
            }
        }
    }

    /**
     * Handle payment failure
     */
    public function failure(Request $request)
    {
        $transactionId = $request->get('order_id');
        
        if ($transactionId) {
            $payment = Payment::where('transaction_id', $transactionId)->first();
            if ($payment) {
                $payment->update(['status' => 'failed']);
            }
        }

        // Check if user is authenticated
        if (auth()->check()) {
            return redirect()->route('student.courses.index')
                           ->with('error', 'Pembayaran gagal. Silakan coba lagi.');
        } else {
            return view('payments.failure', ['payment' => $payment ?? null]);
        }
    }

    /**
     * Handle payment notification from Midtrans
     */
    public function notification(Request $request)
    {
        try {
            $this->midtransService->handleNotification($request);
            return response('OK', 200);
        } catch (\Exception $e) {
            return response('Error: ' . $e->getMessage(), 400);
        }
    }

    /**
     * Check payment status
     */
    public function checkStatus(Payment $payment)
    {
        try {
            $status = $this->midtransService->checkPaymentStatus($payment->transaction_id);
            
            // Update payment status based on Midtrans response
            if ($status['transaction_status'] === 'settlement') {
                $payment->update(['status' => 'completed']);
                $this->midtransService->createEnrollment($payment);
            } elseif ($status['transaction_status'] === 'expire') {
                $payment->update(['status' => 'failed']);
            }

            return response()->json([
                'status' => $payment->status,
                'transaction_status' => $status['transaction_status'] ?? 'unknown'
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Enroll user in free course
     */
    private function enrollFreeCourse(Course $course)
    {
        $user = Auth::user();

        try {
            DB::beginTransaction();

            // Create enrollment
            Enrollment::create([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'enrolled_at' => now(),
                'progress' => 0,
                'learning_hours' => 0,
                'price' => 0,
                'status' => 'active',
            ]);

            // Create payment record for free course
            Payment::create([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'amount' => 0,
                'status' => 'completed',
                'transaction_id' => 'FREE-' . now()->format('Ymd') . '-' . uniqid(),
            ]);

            DB::commit();

            return redirect()->route('student.courses.learn', $course)
                           ->with('success', 'Berhasil mendaftar di kursus gratis! Selamat belajar!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                           ->with('error', 'Gagal mendaftar: ' . $e->getMessage());
        }
    }

    /**
     * Manual status update for local testing
     */
    public function updateStatus(Request $request, Payment $payment)
    {
        // Only allow in local environment
        if (app()->environment('production')) {
            return response()->json(['error' => 'Not allowed in production'], 403);
        }

        $request->validate([
            'status' => 'required|in:pending,completed,failed'
        ]);

        $oldStatus = $payment->status;
        $payment->update(['status' => $request->status]);

        // If status changed to completed, create enrollment
        if ($request->status === 'completed' && $oldStatus !== 'completed') {
            $this->midtransService->createEnrollment($payment);
        }

        return response()->json([
            'success' => true,
            'message' => "Status pembayaran berhasil diubah dari {$oldStatus} menjadi {$request->status}",
            'payment' => $payment->fresh()
        ]);
    }

}
