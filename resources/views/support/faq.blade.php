@extends('layouts.public')

@section('title', 'FAQ - TheSkills')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Frequently Asked Questions</h1>
            <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto">
                Temukan jawaban untuk pertanyaan yang paling sering diajukan
            </p>
        </div>
    </div>
</div>

<!-- Search FAQ -->
<div class="py-8 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative">
            <input type="text" 
                   placeholder="Cari pertanyaan..." 
                   class="w-full pl-12 pr-4 py-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- FAQ Categories -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Kategori Pertanyaan</h2>
            <p class="text-lg text-gray-600">Pilih kategori untuk menemukan jawaban yang relevan</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <button class="bg-blue-50 text-blue-700 px-6 py-3 rounded-lg font-semibold hover:bg-blue-100 transition-colors">
                <i class="fas fa-rocket mr-2"></i>
                Memulai
            </button>
            <button class="bg-gray-50 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                <i class="fas fa-graduation-cap mr-2"></i>
                Kursus
            </button>
            <button class="bg-gray-50 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                <i class="fas fa-credit-card mr-2"></i>
                Pembayaran
            </button>
            <button class="bg-gray-50 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                <i class="fas fa-cog mr-2"></i>
                Teknis
            </button>
        </div>
        
        <!-- FAQ Items -->
        <div class="space-y-4" x-data="{ openFaq: null }">
            <!-- Getting Started FAQs -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button @click="openFaq = openFaq === 1 ? null : 1" 
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <span class="font-semibold text-gray-900">Bagaimana cara mendaftar akun di TheSkills?</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': openFaq === 1 }"></i>
                </button>
                <div x-show="openFaq === 1" x-transition class="px-6 pb-4">
                    <p class="text-gray-600">Untuk mendaftar akun, klik tombol "Register" di pojok kanan atas halaman, isi formulir pendaftaran dengan informasi yang valid, verifikasi email Anda, dan akun siap digunakan!</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button @click="openFaq = openFaq === 2 ? null : 2" 
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <span class="font-semibold text-gray-900">Apakah ada biaya pendaftaran?</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': openFaq === 2 }"></i>
                </button>
                <div x-show="openFaq === 2" x-transition class="px-6 pb-4">
                    <p class="text-gray-600">Tidak ada biaya pendaftaran! Membuat akun di TheSkills sepenuhnya gratis. Anda hanya membayar untuk kursus yang ingin Anda ikuti.</p>
                </div>
            </div>
            
            <!-- Course FAQs -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button @click="openFaq = openFaq === 3 ? null : 3" 
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <span class="font-semibold text-gray-900">Bagaimana cara mendaftar kursus?</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': openFaq === 3 }"></i>
                </button>
                <div x-show="openFaq === 3" x-transition class="px-6 pb-4">
                    <p class="text-gray-600">Pilih kursus yang diinginkan, klik "Daftar Sekarang", pilih metode pembayaran, selesaikan pembayaran, dan Anda akan langsung mendapatkan akses ke kursus tersebut.</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button @click="openFaq = openFaq === 4 ? null : 4" 
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <span class="font-semibold text-gray-900">Apakah saya bisa mengakses kursus kapan saja?</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': openFaq === 4 }"></i>
                </button>
                <div x-show="openFaq === 4" x-transition class="px-6 pb-4">
                    <p class="text-gray-600">Ya! Setelah mendaftar kursus, Anda dapat mengakses materi pembelajaran 24/7 dari perangkat apa pun. Tidak ada batasan waktu untuk menyelesaikan kursus.</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button @click="openFaq = openFaq === 5 ? null : 5" 
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <span class="font-semibold text-gray-900">Bagaimana cara mendapatkan sertifikat?</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': openFaq === 5 }"></i>
                </button>
                <div x-show="openFaq === 5" x-transition class="px-6 pb-4">
                    <p class="text-gray-600">Setelah menyelesaikan semua materi kursus dan lulus ujian dengan nilai minimal 70%, sertifikat digital akan otomatis tersedia untuk diunduh di dashboard Anda.</p>
                </div>
            </div>
            
            <!-- Payment FAQs -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button @click="openFaq = openFaq === 6 ? null : 6" 
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <span class="font-semibold text-gray-900">Metode pembayaran apa saja yang tersedia?</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': openFaq === 6 }"></i>
                </button>
                <div x-show="openFaq === 6" x-transition class="px-6 pb-4">
                    <p class="text-gray-600">Kami menerima pembayaran melalui kartu kredit/debit (Visa, Mastercard), transfer bank, e-wallet (GoPay, OVO, DANA), dan virtual account. Semua transaksi aman dan terenkripsi.</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button @click="openFaq = openFaq === 7 ? null : 7" 
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <span class="font-semibold text-gray-900">Apakah ada jaminan uang kembali?</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': openFaq === 7 }"></i>
                </button>
                <div x-show="openFaq === 7" x-transition class="px-6 pb-4">
                    <p class="text-gray-600">Ya, kami memberikan jaminan uang kembali 30 hari jika Anda tidak puas dengan kursus. Proses refund akan diproses dalam 5-10 hari kerja setelah permohonan disetujui.</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button @click="openFaq = openFaq === 8 ? null : 8" 
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <span class="font-semibold text-gray-900">Bagaimana cara meminta refund?</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': openFaq === 8 }"></i>
                </button>
                <div x-show="openFaq === 8" x-transition class="px-6 pb-4">
                    <p class="text-gray-600">Hubungi tim support kami melalui email support@theskills.com atau live chat, berikan alasan refund, dan kami akan memproses permohonan Anda dalam 1-2 hari kerja.</p>
                </div>
            </div>
            
            <!-- Technical FAQs -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button @click="openFaq = openFaq === 9 ? null : 9" 
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <span class="font-semibold text-gray-900">Video kursus tidak berjalan, bagaimana solusinya?</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': openFaq === 9 }"></i>
                </button>
                <div x-show="openFaq === 9" x-transition class="px-6 pb-4">
                    <p class="text-gray-600">Coba beberapa solusi: refresh halaman, clear cache browser, pastikan koneksi internet stabil, gunakan browser terbaru (Chrome, Firefox, Safari), atau coba perangkat lain. Jika masih bermasalah, hubungi support.</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button @click="openFaq = openFaq === 10 ? null : 10" 
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <span class="font-semibold text-gray-900">Apakah ada aplikasi mobile?</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': openFaq === 10 }"></i>
                </button>
                <div x-show="openFaq === 10" x-transition class="px-6 pb-4">
                    <p class="text-gray-600">Ya! Aplikasi TheSkills tersedia untuk iOS dan Android. Anda dapat mengunduhnya dari App Store atau Google Play Store. Aplikasi memungkinkan Anda belajar di mana saja, bahkan offline.</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button @click="openFaq = openFaq === 11 ? null : 11" 
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <span class="font-semibold text-gray-900">Browser apa saja yang didukung?</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': openFaq === 11 }"></i>
                </button>
                <div x-show="openFaq === 11" x-transition class="px-6 pb-4">
                    <p class="text-gray-600">Kami mendukung browser modern seperti Google Chrome (versi terbaru), Mozilla Firefox, Safari, dan Microsoft Edge. Pastikan JavaScript diaktifkan dan cookies diizinkan untuk pengalaman terbaik.</p>
                </div>
            </div>
            
            <!-- Account FAQs -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button @click="openFaq = openFaq === 12 ? null : 12" 
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <span class="font-semibold text-gray-900">Lupa password, bagaimana cara reset?</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': openFaq === 12 }"></i>
                </button>
                <div x-show="openFaq === 12" x-transition class="px-6 pb-4">
                    <p class="text-gray-600">Klik "Lupa Password" di halaman login, masukkan email Anda, periksa inbox email untuk link reset password, ikuti instruksi di email, dan buat password baru yang kuat.</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button @click="openFaq = openFaq === 13 ? null : 13" 
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <span class="font-semibold text-gray-900">Bagaimana cara menghapus akun?</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': openFaq === 13 }"></i>
                </button>
                <div x-show="openFaq === 13" x-transition class="px-6 pb-4">
                    <p class="text-gray-600">Pergi ke Settings > Account Settings > Delete Account, konfirmasi penghapusan, dan akun Anda akan dihapus permanen dalam 30 hari. Pastikan Anda sudah mengunduh sertifikat yang diperlukan.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Still Need Help -->
<div class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Masih Butuh Bantuan?</h2>
        <p class="text-lg text-gray-600 mb-8">
            Jika Anda tidak menemukan jawaban yang Anda cari, tim support kami siap membantu
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
