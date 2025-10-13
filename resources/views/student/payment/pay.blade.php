@extends('layouts.student-tutor')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900">Pembayaran</h1>
    <p class="text-gray-600 mt-2">Selesaikan pembayaran untuk mengakses kursus</p>
</div>

<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $course->title }}</h2>
            <p class="text-gray-600">Total Pembayaran: <span class="text-2xl font-bold text-blue-600">Rp {{ number_format($course->price, 0, ',', '.') }}</span></p>
            <p class="text-sm text-gray-500 mt-2">Transaction ID: {{ $payment->transaction_id }}</p>
        </div>

        <!-- Midtrans Payment Form -->
        <div class="max-w-2xl mx-auto">
            <div id="snap-container" class="text-center">
                <div class="animate-pulse">
                    <div class="w-16 h-16 bg-blue-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-600">Memuat form pembayaran...</p>
                </div>
            </div>
        </div>

        <!-- Payment Methods Info -->
        <div class="mt-8 border-t border-gray-200 pt-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Metode Pembayaran yang Tersedia</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="text-center p-3 bg-gray-50 rounded-lg">
                    <div class="w-8 h-8 bg-blue-100 rounded-full mx-auto mb-2 flex items-center justify-center">
                        <span class="text-blue-600 font-bold text-sm">CC</span>
                    </div>
                    <p class="text-xs text-gray-600">Credit Card</p>
                </div>
                <div class="text-center p-3 bg-gray-50 rounded-lg">
                    <div class="w-8 h-8 bg-green-100 rounded-full mx-auto mb-2 flex items-center justify-center">
                        <span class="text-green-600 font-bold text-sm">BCA</span>
                    </div>
                    <p class="text-xs text-gray-600">BCA Virtual Account</p>
                </div>
                <div class="text-center p-3 bg-gray-50 rounded-lg">
                    <div class="w-8 h-8 bg-purple-100 rounded-full mx-auto mb-2 flex items-center justify-center">
                        <span class="text-purple-600 font-bold text-sm">OVO</span>
                    </div>
                    <p class="text-xs text-gray-600">OVO</p>
                </div>
                <div class="text-center p-3 bg-gray-50 rounded-lg">
                    <div class="w-8 h-8 bg-orange-100 rounded-full mx-auto mb-2 flex items-center justify-center">
                        <span class="text-orange-600 font-bold text-sm">GOPAY</span>
                    </div>
                    <p class="text-xs text-gray-600">GoPay</p>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-8 text-center">
            <a href="{{ route('student.payment.show', $course) }}" 
               class="inline-flex items-center px-6 py-2 bg-gray-500 text-white text-sm font-medium rounded-lg hover:bg-gray-600 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>
    </div>
</div>

<!-- Midtrans Snap Script -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    // Get snap token from server
    const snapToken = '{{ $snapToken }}';
    
    // Initialize Snap
    snap.pay(snapToken, {
        // Optional
        onSuccess: function(result) {
            console.log('Payment Success:', result);
            window.location.href = '{{ route("student.payment.success") }}?order_id=' + result.order_id;
        },
        onPending: function(result) {
            console.log('Payment Pending:', result);
            window.location.href = '{{ route("student.payment.success") }}?order_id=' + result.order_id;
        },
        onError: function(result) {
            console.log('Payment Error:', result);
            window.location.href = '{{ route("student.payment.failure") }}?order_id=' + result.order_id;
        },
        onClose: function() {
            console.log('Payment Closed');
            // User closed the payment popup
        }
    });
</script>
@endsection
