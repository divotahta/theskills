@extends('layouts.public')

@section('title', 'Terms of Service - TheSkills')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Terms of Service</h1>
            <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto">
                Syarat dan Ketentuan Penggunaan Platform TheSkills
            </p>
        </div>
    </div>
</div>

<!-- Content -->
<div class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="prose prose-lg max-w-none">
            <p class="text-gray-600 mb-8">
                <strong>Terakhir diperbarui:</strong> 1 Januari 2024
            </p>
            
            <div class="space-y-8">
                <!-- Introduction -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Penerimaan Syarat</h2>
                    <p class="text-gray-600 leading-relaxed">
                        Dengan mengakses dan menggunakan platform TheSkills ("Platform"), Anda menyetujui untuk 
                        terikat oleh syarat dan ketentuan ini ("Syarat"). Jika Anda tidak menyetujui syarat-syarat 
                        ini, harap tidak menggunakan Platform kami.
                    </p>
                </section>
                
                <!-- Definitions -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Definisi</h2>
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">2.1 Istilah Kunci</h3>
                            <ul class="list-disc list-inside text-gray-600 space-y-2 ml-4">
                                <li><strong>"Platform"</strong> merujuk pada website, aplikasi, dan layanan TheSkills</li>
                                <li><strong>"Pengguna"</strong> adalah individu yang mengakses atau menggunakan Platform</li>
                                <li><strong>"Kursus"</strong> adalah materi pembelajaran yang tersedia di Platform</li>
                                <li><strong>"Instruktur"</strong> adalah pengguna yang membuat dan mengajar kursus</li>
                                <li><strong>"Siswa"</strong> adalah pengguna yang mengikuti kursus</li>
                            </ul>
                        </div>
                    </div>
                </section>
                
                <!-- User Accounts -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">3. Akun Pengguna</h2>
                    <div class="space-y-4">
                        <div class="bg-blue-50 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-blue-900 mb-2">3.1 Registrasi</h3>
                            <ul class="list-disc list-inside text-blue-800 space-y-1 ml-4">
                                <li>Anda harus memberikan informasi yang akurat dan lengkap</li>
                                <li>Anda bertanggung jawab untuk menjaga keamanan akun Anda</li>
                                <li>Anda harus berusia minimal 13 tahun untuk menggunakan Platform</li>
                                <li>Satu akun per orang, duplikasi akun tidak diperbolehkan</li>
                            </ul>
                        </div>
                        
                        <div class="bg-green-50 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-green-900 mb-2">3.2 Kewajiban Pengguna</h3>
                            <ul class="list-disc list-inside text-green-800 space-y-1 ml-4">
                                <li>Menggunakan Platform sesuai dengan hukum yang berlaku</li>
                                <li>Menghormati hak kekayaan intelektual pihak lain</li>
                                <li>Tidak melakukan aktivitas yang merugikan Platform atau pengguna lain</li>
                                <li>Melaporkan pelanggaran yang Anda temukan</li>
                            </ul>
                        </div>
                    </div>
                </section>
                
                <!-- Course Content -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">4. Konten Kursus</h2>
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">4.1 Hak Kekayaan Intelektual</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Semua konten kursus, termasuk video, teks, gambar, dan materi lainnya, 
                                dilindungi oleh hak cipta dan kekayaan intelektual lainnya. Pengguna tidak 
                                diperbolehkan untuk menyalin, mendistribusikan, atau menggunakan konten 
                                untuk tujuan komersial tanpa izin tertulis.
                            </p>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">4.2 Lisensi Penggunaan</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Dengan membeli atau mengakses kursus, Anda mendapatkan lisensi terbatas 
                                untuk menggunakan konten untuk tujuan pembelajaran pribadi. Lisensi ini 
                                tidak dapat dipindahtangankan atau disublisensikan.
                            </p>
                        </div>
                    </div>
                </section>
                
                <!-- Payment Terms -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">5. Syarat Pembayaran</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">5.1 Harga dan Pajak</h3>
                            <ul class="list-disc list-inside text-gray-600 space-y-1 ml-4">
                                <li>Harga kursus dapat berubah sewaktu-waktu</li>
                                <li>Pajak akan ditambahkan sesuai ketentuan</li>
                                <li>Pembayaran harus dilakukan sebelum akses kursus</li>
                            </ul>
                        </div>
                        
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">5.2 Refund</h3>
                            <ul class="list-disc list-inside text-gray-600 space-y-1 ml-4">
                                <li>Refund tersedia dalam 30 hari pertama</li>
                                <li>Kursus yang sudah diselesaikan tidak dapat direfund</li>
                                <li>Proses refund memakan waktu 5-10 hari kerja</li>
                            </ul>
                        </div>
                    </div>
                </section>
                
                <!-- Prohibited Activities -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">6. Aktivitas yang Dilarang</h2>
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-red-900 mb-2">Dilarang keras melakukan:</h3>
                        <ul class="list-disc list-inside text-red-800 space-y-1 ml-4">
                            <li>Menggunakan Platform untuk aktivitas ilegal atau berbahaya</li>
                            <li>Mengganggu atau merusak operasi Platform</li>
                            <li>Mencoba mengakses akun pengguna lain tanpa izin</li>
                            <li>Menyebarkan malware, virus, atau kode berbahaya</li>
                            <li>Melakukan spam atau komunikasi yang tidak diinginkan</li>
                            <li>Melanggar hak kekayaan intelektual pihak lain</li>
                            <li>Menggunakan bot atau script otomatis</li>
                        </ul>
                    </div>
                </section>
                
                <!-- Privacy and Data -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">7. Privasi dan Data</h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Penggunaan data pribadi Anda diatur oleh Kebijakan Privasi kami. Dengan menggunakan 
                        Platform, Anda menyetujui pengumpulan dan penggunaan data sesuai dengan kebijakan tersebut.
                    </p>
                    <div class="bg-blue-50 rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-blue-900 mb-2">Data yang Kami Kumpulkan:</h3>
                        <ul class="list-disc list-inside text-blue-800 space-y-1 ml-4">
                            <li>Informasi profil dan kontak</li>
                            <li>Data penggunaan platform</li>
                            <li>Progress pembelajaran</li>
                            <li>Informasi pembayaran (dienkripsi)</li>
                        </ul>
                    </div>
                </section>
                
                <!-- Termination -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">8. Penghentian Layanan</h2>
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">8.1 Penghentian oleh Pengguna</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Anda dapat menghentikan penggunaan Platform kapan saja dengan menghapus akun Anda. 
                                Data pribadi Anda akan dihapus sesuai dengan Kebijakan Privasi kami.
                            </p>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">8.2 Penghentian oleh Kami</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Kami berhak menghentikan atau menangguhkan akses Anda ke Platform jika Anda 
                                melanggar syarat-syarat ini atau melakukan aktivitas yang merugikan.
                            </p>
                        </div>
                    </div>
                </section>
                
                <!-- Disclaimers -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">9. Penafian</h2>
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-yellow-900 mb-2">Platform disediakan "sebagaimana adanya":</h3>
                        <ul class="list-disc list-inside text-yellow-800 space-y-1 ml-4">
                            <li>Kami tidak menjamin ketersediaan Platform 100%</li>
                            <li>Konten kursus adalah tanggung jawab instruktur</li>
                            <li>Hasil pembelajaran dapat bervariasi</li>
                            <li>Kami tidak bertanggung jawab atas kerugian tidak langsung</li>
                        </ul>
                    </div>
                </section>
                
                <!-- Limitation of Liability -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">10. Pembatasan Tanggung Jawab</h2>
                    <p class="text-gray-600 leading-relaxed">
                        Dalam batas maksimum yang diizinkan oleh hukum, TheSkills tidak akan bertanggung jawab 
                        atas kerugian langsung, tidak langsung, insidental, khusus, atau konsekuensial yang 
                        timbul dari penggunaan Platform.
                    </p>
                </section>
                
                <!-- Changes to Terms -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">11. Perubahan Syarat</h2>
                    <p class="text-gray-600 leading-relaxed">
                        Kami dapat mengubah syarat-syarat ini dari waktu ke waktu. Perubahan material akan 
                        diberitahukan melalui email atau pemberitahuan di Platform. Penggunaan berkelanjutan 
                        setelah perubahan dianggap sebagai penerimaan syarat-syarat yang baru.
                    </p>
                </section>
                
                <!-- Governing Law -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">12. Hukum yang Berlaku</h2>
                    <p class="text-gray-600 leading-relaxed">
                        Syarat-syarat ini diatur oleh dan ditafsirkan sesuai dengan hukum Republik Indonesia. 
                        Setiap sengketa akan diselesaikan melalui pengadilan yang berwenang di Jakarta.
                    </p>
                </section>
                
                <!-- Contact Information -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">13. Informasi Kontak</h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Jika Anda memiliki pertanyaan tentang Syarat Layanan ini, silakan hubungi kami:
                    </p>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-2">Email</h3>
                                <p class="text-gray-600">legal@theskills.com</p>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-2">Alamat</h3>
                                <p class="text-gray-600">Jl. Sudirman No. 123<br>Jakarta Pusat 10270</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="py-16 bg-gradient-to-r from-blue-600 to-purple-600">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Setuju dengan Syarat Kami?</h2>
        <p class="text-xl text-blue-100 mb-8">
            Bergabunglah dengan ribuan pengguna yang sudah mempercayai TheSkills
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" 
               class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                <i class="fas fa-user-plus mr-2"></i>
                Daftar Sekarang
            </a>
            <a href="{{ route('courses.index') }}" 
               class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors">
                <i class="fas fa-graduation-cap mr-2"></i>
                Jelajahi Kursus
            </a>
        </div>
    </div>
</div>
@endsection
