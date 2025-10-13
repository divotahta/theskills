@extends('layouts.student-tutor')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900">Pembayaran Kursus</h1>
    <p class="text-gray-600 mt-2">Selesaikan pembayaran untuk mengakses kursus</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Course Information -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-start space-x-4">
                @if($course->thumbnail)
                    <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" class="w-24 h-24 rounded-lg object-cover">
                @else
                    <div class="w-24 h-24 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-2xl font-bold">
                        {{ Str::limit($course->title, 2, '') }}
                    </div>
                @endif
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-gray-900">{{ $course->title }}</h2>
                    <p class="text-gray-600 mt-1">
                        <span class="font-medium">{{ $course->instructor->name }}</span> • 
                        <span class="text-blue-600">{{ $course->category->name }}</span>
                    </p>
                    <div class="flex items-center mt-2 text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ $course->contents->count() }} Pelajaran
                    </div>
                    <div class="flex items-center mt-1 text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Level: {{ $course->courseLevel->name ?? 'Not Set' }}
                    </div>
                </div>
            </div>
            
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Deskripsi Kursus</h3>
                <p class="text-gray-700 leading-relaxed">{{ $course->description ?? 'Tidak ada deskripsi tersedia.' }}</p>
            </div>

            @if($course->topics && $course->topics->count() > 0)
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Materi yang Akan Dipelajari</h3>
                <div class="space-y-2">
                    @foreach($course->topics as $topic)
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            {{ $topic->title }}
                        </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Materi yang Akan Dipelajari</h3>
                <div class="space-y-2">
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Pengenalan Dasar
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Praktik Langsung
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Proyek Akhir
                    </div>
                </div>
            </div>
            @endif

            <!-- Course Features -->
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Fitur Kursus</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ $course->contents->count() }} Video Pelajaran
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Sertifikat Penyelesaian
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Akses Seumur Hidup
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-4 h-4 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Dukungan 24/7
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Information -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Detail Pembayaran</h3>
            
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Harga Kursus</span>
                    <span class="text-lg font-semibold text-gray-900">Rp {{ number_format($course->price, 0, ',', '.') }}</span>
                </div>
                
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Pajak (0%)</span>
                    <span class="text-gray-900">Rp 0</span>
                </div>
                
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Diskon</span>
                    <span class="text-green-600">- Rp 0</span>
                </div>
                
                <hr class="border-gray-200">
                
                <div class="flex justify-between items-center">
                    <span class="text-lg font-semibold text-gray-900">Total Pembayaran</span>
                    <span class="text-2xl font-bold text-blue-600">Rp {{ number_format($course->price, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Payment Methods -->
            <div class="mt-6">
                <h4 class="text-sm font-semibold text-gray-900 mb-3">Metode Pembayaran</h4>
                <div class="grid grid-cols-2 gap-2">
                    <div class="flex items-center justify-center p-2 bg-gray-50 rounded-lg text-xs text-gray-600">
                        <span class="font-semibold">Credit Card</span>
                    </div>
                    <div class="flex items-center justify-center p-2 bg-gray-50 rounded-lg text-xs text-gray-600">
                        <span class="font-semibold">BCA VA</span>
                    </div>
                    <div class="flex items-center justify-center p-2 bg-gray-50 rounded-lg text-xs text-gray-600">
                        <span class="font-semibold">OVO</span>
                    </div>
                    <div class="flex items-center justify-center p-2 bg-gray-50 rounded-lg text-xs text-gray-600">
                        <span class="font-semibold">GoPay</span>
                    </div>
                </div>
            </div>

            @if($pendingPayment)
                <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-yellow-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm font-medium text-yellow-800">Pembayaran Pending</span>
                    </div>
                    <p class="text-sm text-yellow-700 mt-1">Anda memiliki pembayaran yang belum selesai untuk kursus ini.</p>
                    <div class="mt-3">
                        <form action="{{ route('student.payment.create', $course) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white text-sm font-medium rounded-lg hover:bg-yellow-700 transition-colors">
                                Lanjutkan Pembayaran
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="mt-6">
                    <form action="{{ route('student.payment.create', $course) }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                            Bayar Sekarang
                        </button>
                    </form>
                </div>
            @endif

            <!-- Instructor Info -->
            <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                <h4 class="text-sm font-semibold text-gray-900 mb-2">Instruktur</h4>
                <div class="flex items-center">
                    @if($course->instructor->avatar)
                        <img src="{{ Storage::url($course->instructor->avatar) }}" alt="{{ $course->instructor->name }}" class="w-8 h-8 rounded-full mr-3">
                    @else
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-sm font-bold mr-3">
                            {{ Str::limit($course->instructor->name, 1, '') }}
                        </div>
                    @endif
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $course->instructor->name }}</p>
                        <p class="text-xs text-gray-500">Instruktur Profesional</p>
                    </div>
                </div>
            </div>

            <div class="mt-6 text-center">
                <p class="text-xs text-gray-500">
                    Pembayaran aman dan terjamin dengan Midtrans
                </p>
                <div class="flex justify-center items-center mt-2 space-x-2">
                    <span class="text-xs text-gray-400">Powered by</span>
                    <span class="text-sm font-semibold text-blue-600">Midtrans</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
