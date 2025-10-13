<?php

namespace App\Services;

use Midtrans\Snap;
use App\Models\User;
use Midtrans\Config;
use Midtrans\CoreApi;
use App\Models\Course;
use App\Models\Payment;
use Midtrans\Transaction;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    /**
     * Create payment transaction
     */
    public function createPayment(Payment $payment, User $user, Course $course)
    {
        $transactionDetails = [
            'order_id' => $payment->transaction_id,
            'gross_amount' => (int) $payment->amount,
        ];

        $customerDetails = [
            'first_name' => explode(' ', $user->name)[0],
            'last_name' => count(explode(' ', $user->name)) > 1 ? implode(' ', array_slice(explode(' ', $user->name), 1)) : '',
            'email' => $user->email,
            'phone' => $user->phone ?? '08123456789',
            'billing_address' => [
                'first_name' => explode(' ', $user->name)[0],
                'last_name' => count(explode(' ', $user->name)) > 1 ? implode(' ', array_slice(explode(' ', $user->name), 1)) : '',
                'email' => $user->email,
                'phone' => $user->phone ?? '08123456789',
                'address' => $user->address ?? 'Jakarta',
                'city' => 'Jakarta',
                'postal_code' => '12345',
                'country_code' => 'IDN'
            ],
            'shipping_address' => [
                'first_name' => explode(' ', $user->name)[0],
                'last_name' => count(explode(' ', $user->name)) > 1 ? implode(' ', array_slice(explode(' ', $user->name), 1)) : '',
                'email' => $user->email,
                'phone' => $user->phone ?? '08123456789',
                'address' => $user->address ?? 'Jakarta',
                'city' => 'Jakarta',
                'postal_code' => '12345',
                'country_code' => 'IDN'
            ]
        ];

        $itemDetails = [
            [
                'id' => (string) $course->id,
                'price' => (int) $course->price,
                'quantity' => 1,
                'name' => $course->title,
                'category' => $course->category->name ?? 'Online Course',
                'merchant_name' => 'TheSkills Academy'
            ]
        ];

        $params = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
            'item_details' => $itemDetails,
            'callbacks' => [
                'finish' => url('/student/payment/success'),
                'unfinish' => url('/student/payment/failure'),
                'error' => url('/student/payment/failure')
            ]
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return $snapToken;
        } catch (\Exception $e) {
            Log::error('Midtrans payment creation failed: ' . $e->getMessage());
            throw new \Exception('Failed to create payment: ' . $e->getMessage());
        }
    }

    /**
     * Handle payment notification
     */
    public function handleNotification($request)
    {
        $notification = $request->all();
        
        $orderId = $notification['order_id'];
        $statusCode = $notification['status_code'];
        $grossAmount = $notification['gross_amount'];
        $signatureKey = $notification['signature_key'];

        // Verify signature
        $expectedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . config('midtrans.server_key'));
        
        if ($signatureKey !== $expectedSignature) {
            Log::error('Invalid Midtrans signature for order: ' . $orderId);
            return response('Invalid signature', 400);
        }

        $payment = Payment::where('transaction_id', $orderId)->first();
        
        if (!$payment) {
            Log::error('Payment not found for order: ' . $orderId);
            return response('Payment not found', 404);
        }

        // Update payment status based on notification
        switch ($statusCode) {
            case '200':
                $payment->update(['status' => 'completed']);
                $this->createEnrollment($payment);
                Log::info('Payment completed for order: ' . $orderId);
                break;
            case '201':
                $payment->update(['status' => 'pending']);
                Log::info('Payment pending for order: ' . $orderId);
                break;
            case '202':
                $payment->update(['status' => 'failed']);
                Log::info('Payment failed for order: ' . $orderId);
                break;
        }

        return response('OK', 200);
    }

    /**
     * Create enrollment after successful payment
     */
    public function createEnrollment(Payment $payment)
    {
        // Check if enrollment already exists
        $existingEnrollment = \App\Models\Enrollment::where('user_id', $payment->user_id)
                                                   ->where('course_id', $payment->course_id)
                                                   ->first();

        if (!$existingEnrollment) {
            \App\Models\Enrollment::create([
                'user_id' => $payment->user_id,
                'course_id' => $payment->course_id,
                'enrolled_at' => now(),
                'progress' => 0,
                'learning_hours' => 0,
                'price' => $payment->amount,
                'status' => 'active',
            ]);
            Log::info('Enrollment created for user: ' . $payment->user_id . ', course: ' . $payment->course_id);
        }
    }

    /**
     * Check payment status
     */
    public function checkPaymentStatus($transactionId)
    {
        try {
            $status = Transaction::status($transactionId);
            return $status;
        } catch (\Exception $e) {
            throw new \Exception('Failed to check payment status: ' . $e->getMessage());
        }
    }

    /**
     * Generate unique transaction ID
     */
    public function generateTransactionId()
    {
        return 'TXN-' . now()->format('Ymd') . '-' . Str::random(8);
    }
}
