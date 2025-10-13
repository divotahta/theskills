@extends('layouts.public')

@section('title', 'Help Center - TheSkills')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Help Center</h1>
            <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto">
                Temukan panduan lengkap dan solusi untuk masalah Anda
            </p>
        </div>
    </div>
</div>

<!-- Search Help -->
<div class="py-8 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative">
            <input type="text" 
                   placeholder="Cari bantuan..." 
                   class="w-full pl-12 pr-4 py-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Help Categories -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Getting Started -->
            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-rocket text-blue-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">Memulai</h3>
                </div>
                <ul class="space-y-3">
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Cara mendaftar akun</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Verifikasi email</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Mengatur profil</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Navigasi platform</a></li>
                </ul>
            </div>
            
            <!-- Courses -->
            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-graduation-cap text-green-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">Kursus</h3>
                </div>
                <ul class="space-y-3">
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Mendaftar kursus</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Mengakses materi</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Mengikuti quiz</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Mendapatkan sertifikat</a></li>
                </ul>
            </div>
            
            <!-- Payment -->
            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-credit-card text-purple-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">Pembayaran</h3>
                </div>
                <ul class="space-y-3">
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Metode pembayaran</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Proses refund</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Invoice dan receipt</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Masalah pembayaran</a></li>
                </ul>
            </div>
            
            <!-- Technical -->
            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-cog text-orange-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">Teknis</h3>
                </div>
                <ul class="space-y-3">
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Video tidak berjalan</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Masalah loading</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Browser compatibility</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Mobile app issues</a></li>
                </ul>
            </div>
            
            <!-- Account -->
            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-user text-red-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">Akun</h3>
                </div>
                <ul class="space-y-3">
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Lupa password</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Update profil</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Hapus akun</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Keamanan akun</a></li>
                </ul>
            </div>
            
            <!-- Instructor -->
            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-chalkboard-teacher text-indigo-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">Instruktur</h3>
                </div>
                <ul class="space-y-3">
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Cara menjadi instruktur</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Membuat kursus</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Mengelola siswa</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">Pembayaran instruktur</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Popular Articles -->
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Artikel Populer</h2>
            <p class="text-lg text-gray-600">Panduan yang paling sering dicari</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-star text-blue-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Cara Mendaftar Kursus</h3>
                        <p class="text-sm text-gray-500">Panduan lengkap untuk mendaftar kursus</p>
                    </div>
                </div>
                <p class="text-gray-600 text-sm mb-4">Pelajari langkah-langkah mudah untuk mendaftar dan mengakses kursus yang Anda inginkan...</p>
                <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Baca selengkapnya →</a>
            </div>
            
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-star text-green-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Troubleshooting Video</h3>
                        <p class="text-sm text-gray-500">Solusi untuk masalah video tidak berjalan</p>
                    </div>
                </div>
                <p class="text-gray-600 text-sm mb-4">Jika video kursus tidak berjalan dengan baik, ikuti panduan ini untuk mengatasinya...</p>
                <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Baca selengkapnya →</a>
            </div>
            
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-star text-purple-600"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Cara Mendapatkan Sertifikat</h3>
                        <p class="text-sm text-gray-500">Panduan untuk mendapatkan sertifikat kursus</p>
                    </div>
                </div>
                <p class="text-gray-600 text-sm mb-4">Setelah menyelesaikan kursus, ikuti langkah-langkah ini untuk mengunduh sertifikat...</p>
                <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Baca selengkapnya →</a>
            </div>
        </div>
    </div>
</div>

<!-- Contact Support -->
<div class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Tidak Menemukan Solusi?</h2>
        <p class="text-lg text-gray-600 mb-8">
            Tim support kami siap membantu Anda dengan masalah yang lebih spesifik
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('contact') }}" 
               class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-purple-700 transition-all duration-200">
                <i class="fas fa-envelope mr-2"></i>
                Hubungi Support
            </a>
            <a href="{{ route('support.faq') }}" 
               class="border-2 border-blue-600 text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-600 hover:text-white transition-all duration-200">
                <i class="fas fa-question-circle mr-2"></i>
                Lihat FAQ
            </a>
        </div>
    </div>
</div>
@endsection
