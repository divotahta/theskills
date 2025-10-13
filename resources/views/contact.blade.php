@extends('layouts.public')

@section('title', 'Contact Us - TheSkills')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Hubungi Kami</h1>
            <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto">
                Ada pertanyaan? Kami siap membantu Anda 24/7
            </p>
        </div>
    </div>
</div>

<!-- Contact Information -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Kirim Pesan</h2>
                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="firstName" class="block text-sm font-medium text-gray-700 mb-2">Nama Depan</label>
                            <input type="text" id="firstName" name="firstName" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                   placeholder="Masukkan nama depan">
                        </div>
                        <div>
                            <label for="lastName" class="block text-sm font-medium text-gray-700 mb-2">Nama Belakang</label>
                            <input type="text" id="lastName" name="lastName" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                   placeholder="Masukkan nama belakang">
                        </div>
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                               placeholder="Masukkan email Anda">
                    </div>
                    
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                        <input type="tel" id="phone" name="phone" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                               placeholder="Masukkan nomor telepon">
                    </div>
                    
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subjek</label>
                        <select id="subject" name="subject" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            <option value="">Pilih subjek</option>
                            <option value="general">Pertanyaan Umum</option>
                            <option value="technical">Bantuan Teknis</option>
                            <option value="billing">Pertanyaan Billing</option>
                            <option value="course">Pertanyaan Kursus</option>
                            <option value="partnership">Kemitraan</option>
                            <option value="other">Lainnya</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Pesan</label>
                        <textarea id="message" name="message" rows="6" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                  placeholder="Tulis pesan Anda di sini..."></textarea>
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-purple-700 transition-all duration-200 shadow-md hover:shadow-lg">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Kirim Pesan
                    </button>
                </form>
            </div>
            
            <!-- Contact Information -->
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Informasi Kontak</h2>
                <div class="space-y-8">
                    <!-- Office Address -->
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-map-marker-alt text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Alamat Kantor</h3>
                            <p class="text-gray-600">
                                Jl. Sudirman No. 123<br>
                                Jakarta Pusat 10270<br>
                                Indonesia
                            </p>
                        </div>
                    </div>
                    
                    <!-- Phone -->
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-phone text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Telepon</h3>
                            <p class="text-gray-600">
                                <a href="tel:+6281234567890" class="hover:text-blue-600 transition-colors">
                                    +62 812 3456 7890
                                </a><br>
                                <a href="tel:+6281234567891" class="hover:text-blue-600 transition-colors">
                                    +62 812 3456 7891
                                </a>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Email -->
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-envelope text-purple-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Email</h3>
                            <p class="text-gray-600">
                                <a href="mailto:info@theskills.com" class="hover:text-blue-600 transition-colors">
                                    info@theskills.com
                                </a><br>
                                <a href="mailto:support@theskills.com" class="hover:text-blue-600 transition-colors">
                                    support@theskills.com
                                </a>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Business Hours -->
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-clock text-orange-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Jam Operasional</h3>
                            <p class="text-gray-600">
                                Senin - Jumat: 08:00 - 17:00 WIB<br>
                                Sabtu: 08:00 - 12:00 WIB<br>
                                Minggu: Tutup
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media -->
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white hover:bg-blue-700 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-400 rounded-lg flex items-center justify-center text-white hover:bg-blue-500 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-pink-600 rounded-lg flex items-center justify-center text-white hover:bg-pink-700 transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-700 rounded-lg flex items-center justify-center text-white hover:bg-blue-800 transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center text-white hover:bg-red-700 transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FAQ Section -->
<div class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Pertanyaan yang Sering Diajukan</h2>
            <p class="text-lg text-gray-600">Temukan jawaban untuk pertanyaan umum</p>
        </div>
        
        <div class="space-y-4" x-data="{ openFaq: null }">
            <div class="bg-white rounded-lg shadow-sm">
                <button @click="openFaq = openFaq === 1 ? null : 1" 
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <span class="font-semibold text-gray-900">Bagaimana cara mendaftar kursus?</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': openFaq === 1 }"></i>
                </button>
                <div x-show="openFaq === 1" x-transition class="px-6 pb-4">
                    <p class="text-gray-600">Anda dapat mendaftar kursus dengan mudah melalui halaman kursus. Pilih kursus yang diinginkan, klik tombol "Daftar Sekarang", dan ikuti proses pembayaran.</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm">
                <button @click="openFaq = openFaq === 2 ? null : 2" 
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <span class="font-semibold text-gray-900">Apakah ada sertifikat setelah menyelesaikan kursus?</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': openFaq === 2 }"></i>
                </button>
                <div x-show="openFaq === 2" x-transition class="px-6 pb-4">
                    <p class="text-gray-600">Ya, Anda akan mendapatkan sertifikat digital yang dapat diunduh setelah menyelesaikan kursus dengan nilai minimal 70%.</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm">
                <button @click="openFaq = openFaq === 3 ? null : 3" 
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <span class="font-semibold text-gray-900">Bagaimana cara menghubungi instruktur?</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': openFaq === 3 }"></i>
                </button>
                <div x-show="openFaq === 3" x-transition class="px-6 pb-4">
                    <p class="text-gray-600">Anda dapat menghubungi instruktur melalui forum diskusi di dalam kursus atau melalui fitur pesan pribadi yang tersedia di platform.</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm">
                <button @click="openFaq = openFaq === 4 ? null : 4" 
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <span class="font-semibold text-gray-900">Apakah ada jaminan uang kembali?</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': openFaq === 4 }"></i>
                </button>
                <div x-show="openFaq === 4" x-transition class="px-6 pb-4">
                    <p class="text-gray-600">Ya, kami memberikan jaminan uang kembali 30 hari jika Anda tidak puas dengan kursus yang telah dibeli.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Map Section -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Lokasi Kami</h2>
            <p class="text-lg text-gray-600">Kunjungi kantor kami di Jakarta</p>
        </div>
        <div class="bg-gray-200 rounded-lg h-96 flex items-center justify-center">
            <div class="text-center">
                <i class="fas fa-map-marked-alt text-6xl text-gray-400 mb-4"></i>
                <p class="text-gray-600 text-lg">Peta Lokasi Kantor</p>
                <p class="text-gray-500">Jl. Sudirman No. 123, Jakarta Pusat</p>
            </div>
        </div>
    </div>
</div>
@endsection
