@extends('layouts.public')

@section('title', 'Support Center - TheSkills')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Support Center</h1>
            <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto">
                Kami siap membantu Anda dengan segala pertanyaan dan masalah
            </p>
        </div>
    </div>
</div>

<!-- Support Options -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Help Center -->
            <a href="{{ route('support.help-center') }}" 
               class="group bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-200 border border-gray-200 hover:border-blue-300">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition-colors">
                        <i class="fas fa-question-circle text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Help Center</h3>
                    <p class="text-gray-600 text-sm">Temukan jawaban untuk pertanyaan umum dan panduan lengkap</p>
                </div>
            </a>
            
            <!-- Privacy Policy -->
            <a href="{{ route('support.privacy-policy') }}" 
               class="group bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-200 border border-gray-200 hover:border-green-300">
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-green-200 transition-colors">
                        <i class="fas fa-shield-alt text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Privacy Policy</h3>
                    <p class="text-gray-600 text-sm">Pelajari bagaimana kami melindungi data dan privasi Anda</p>
                </div>
            </a>
            
            <!-- Terms of Service -->
            <a href="{{ route('support.terms-of-service') }}" 
               class="group bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-200 border border-gray-200 hover:border-purple-300">
                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-purple-200 transition-colors">
                        <i class="fas fa-file-contract text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Terms of Service</h3>
                    <p class="text-gray-600 text-sm">Syarat dan ketentuan penggunaan platform TheSkills</p>
                </div>
            </a>
            
            <!-- FAQ -->
            <a href="{{ route('support.faq') }}" 
               class="group bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-200 border border-gray-200 hover:border-orange-300">
                <div class="text-center">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-orange-200 transition-colors">
                        <i class="fas fa-comments text-orange-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">FAQ</h3>
                    <p class="text-gray-600 text-sm">Pertanyaan yang sering diajukan dan jawabannya</p>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- Quick Help Section -->
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Bantuan Cepat</h2>
            <p class="text-lg text-gray-600">Temukan solusi untuk masalah umum</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Account Issues -->
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-user-cog text-blue-600 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Masalah Akun</h3>
                </div>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li>• Lupa password</li>
                    <li>• Verifikasi email</li>
                    <li>• Update profil</li>
                    <li>• Hapus akun</li>
                </ul>
            </div>
            
            <!-- Course Issues -->
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-graduation-cap text-green-600 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Masalah Kursus</h3>
                </div>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li>• Tidak bisa akses kursus</li>
                    <li>• Video tidak berjalan</li>
                    <li>• Sertifikat tidak muncul</li>
                    <li>• Progress tidak tersimpan</li>
                </ul>
            </div>
            
            <!-- Payment Issues -->
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-credit-card text-purple-600 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Masalah Pembayaran</h3>
                </div>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li>• Pembayaran gagal</li>
                    <li>• Refund</li>
                    <li>• Invoice tidak muncul</li>
                    <li>• Metode pembayaran</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Contact Support -->
<div class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Masih Butuh Bantuan?</h2>
        <p class="text-lg text-gray-600 mb-8">
            Tim support kami siap membantu Anda 24/7. Hubungi kami melalui berbagai channel yang tersedia.
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-envelope text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Email Support</h3>
                <p class="text-gray-600 mb-4">support@theskills.com</p>
                <a href="mailto:support@theskills.com" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-paper-plane mr-2"></i>
                    Kirim Email
                </a>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-phone text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Telepon</h3>
                <p class="text-gray-600 mb-4">+62 812 3456 7890</p>
                <a href="tel:+6281234567890" 
                   class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    <i class="fas fa-phone mr-2"></i>
                    Hubungi Sekarang
                </a>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-comments text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Live Chat</h3>
                <p class="text-gray-600 mb-4">Chat langsung dengan tim support</p>
                <button class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                    <i class="fas fa-comment-dots mr-2"></i>
                    Mulai Chat
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
