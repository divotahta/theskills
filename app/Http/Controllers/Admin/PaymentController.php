<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * Display all payments for local testing
     */
    public function index()
    {
        // Only allow in local environment
        if (app()->environment('production')) {
            abort(403, 'Not allowed in production');
        }

        $payments = Payment::with(['user', 'course'])
                          ->orderBy('created_at', 'desc')
                          ->paginate(20);

        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Manual status update for local testing
     */
    public function updateStatus(Request $request, Payment $payment)
    {
        // Only allow in local environment
        // if (app()->environment('production')) {
        //     return response()->json(['error' => 'Not allowed in production'], 403);
        // }

        $request->validate([
            'status' => 'required|in:pending,completed,failed'
        ]);

        $oldStatus = $payment->status;
        $payment->update(['status' => $request->status]);

        // If status changed to completed, create enrollment
        if ($request->status === 'completed' && $oldStatus !== 'completed') {
            try {
                $midtransService = app(\App\Services\MidtransService::class);
                $midtransService->createEnrollment($payment);
                
                Log::info("Payment {$payment->transaction_id} marked as completed and enrollment created");
            } catch (\Exception $e) {
                Log::error("Failed to create enrollment for payment {$payment->transaction_id}: " . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Status pembayaran berhasil diubah dari {$oldStatus} menjadi {$request->status}",
            'payment' => $payment->fresh()
        ]);
    }
}
