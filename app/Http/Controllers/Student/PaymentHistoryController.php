<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentHistoryController extends Controller
{
    /**
     * Display payment history for the authenticated student
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Get payment history with course and enrollment information
        $payments = Payment::with(['course', 'course.instructor', 'course.category', 'enrollment'])
                          ->where('user_id', $user->id)
                          ->orderBy('created_at', 'desc')
                          ->paginate(10);

        // Get payment statistics
        $stats = [
            'total_payments' => Payment::where('user_id', $user->id)->count(),
            'completed_payments' => Payment::where('user_id', $user->id)->where('status', 'completed')->count(),
            'pending_payments' => Payment::where('user_id', $user->id)->where('status', 'pending')->count(),
            'failed_payments' => Payment::where('user_id', $user->id)->where('status', 'failed')->count(),
            'total_amount' => Payment::where('user_id', $user->id)->where('status', 'completed')->sum('amount'),
        ];

        // Filter by status if requested
        $statusFilter = $request->get('status');
        if ($statusFilter && in_array($statusFilter, ['pending', 'completed', 'failed'])) {
            $payments = Payment::with(['course', 'course.instructor', 'course.category', 'enrollment'])
                              ->where('user_id', $user->id)
                              ->where('status', $statusFilter)
                              ->orderBy('created_at', 'desc')
                              ->paginate(10);
        }

        return view('student.payment-history', compact('payments', 'stats', 'statusFilter'));
    }

    /**
     * Show details of a specific payment
     */
    public function show(Payment $payment)
    {
        // Ensure the payment belongs to the authenticated user
        if ($payment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to payment details.');
        }

        $payment->load(['course', 'course.instructor', 'course.category', 'enrollment']);

        return view('student.payment-details', compact('payment'));
    }
}
