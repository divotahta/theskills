@extends('layouts.public')

@section('title', 'Privacy Policy - TheSkills')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Privacy Policy</h1>
            <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto">
                Kebijakan Privasi TheSkills - Bagaimana Kami Melindungi Data Anda
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
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Pengenalan</h2>
                    <p class="text-gray-600 leading-relaxed">
                        TheSkills ("kami", "kita", atau "platform") berkomitmen untuk melindungi privasi dan keamanan 
                        informasi pribadi Anda. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, 
                        menggunakan, menyimpan, dan melindungi informasi Anda ketika Anda menggunakan platform 
                        pembelajaran online TheSkills.
                    </p>
                </section>
                
                <!-- Information We Collect -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Informasi yang Kami Kumpulkan</h2>
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">2.1 Informasi yang Anda Berikan</h3>
                            <ul class="list-disc list-inside text-gray-600 space-y-2 ml-4">
                                <li>Nama lengkap dan informasi kontak (email, nomor telepon)</li>
                                <li>Informasi profil (foto, tanggal lahir, jenis kelamin)</li>
                                <li>Informasi akun (username, password)</li>
                                <li>Informasi pembayaran (kartu kredit, rekening bank)</li>
                                <li>Konten yang Anda buat (komentar, review, tugas)</li>
                            </ul>
                        </div>
                        
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">2.2 Informasi yang Dikumpulkan Otomatis</h3>
                            <ul class="list-disc list-inside text-gray-600 space-y-2 ml-4">
                                <li>Data penggunaan platform (halaman yang dikunjungi, waktu akses)</li>
                                <li>Informasi perangkat (IP address, browser, sistem operasi)</li>
                                <li>Data lokasi (jika diizinkan)</li>
                                <li>Cookies dan teknologi pelacakan serupa</li>
                            </ul>
                        </div>
                    </div>
                </section>
                
                <!-- How We Use Information -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">3. Cara Kami Menggunakan Informasi</h2>
                    <div class="space-y-4">
                        <div class="bg-blue-50 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-blue-900 mb-2">Tujuan Utama</h3>
                            <ul class="list-disc list-inside text-blue-800 space-y-1 ml-4">
                                <li>Menyediakan dan mengelola layanan pembelajaran</li>
                                <li>Memproses pembayaran dan transaksi</li>
                                <li>Mengirim notifikasi dan update penting</li>
                                <li>Memberikan dukungan pelanggan</li>
                            </ul>
                        </div>
                        
                        <div class="bg-green-50 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-green-900 mb-2">Tujuan Tambahan</h3>
                            <ul class="list-disc list-inside text-green-800 space-y-1 ml-4">
                                <li>Meningkatkan kualitas layanan</li>
                                <li>Mengembangkan fitur baru</li>
                                <li>Menganalisis pola penggunaan</li>
                                <li>Mencegah penipuan dan penyalahgunaan</li>
                            </ul>
                        </div>
                    </div>
                </section>
                
                <!-- Data Sharing -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">4. Berbagi Informasi</h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Kami tidak menjual, menyewakan, atau membagikan informasi pribadi Anda kepada pihak ketiga, 
                        kecuali dalam situasi berikut:
                    </p>
                    <ul class="list-disc list-inside text-gray-600 space-y-2 ml-4">
                        <li><strong>Dengan persetujuan Anda:</strong> Ketika Anda secara eksplisit memberikan izin</li>
                        <li><strong>Penyedia layanan:</strong> Dengan vendor tepercaya yang membantu operasi platform</li>
                        <li><strong>Kewajiban hukum:</strong> Ketika diwajibkan oleh hukum atau untuk melindungi hak kami</li>
                        <li><strong>Keamanan:</strong> Untuk mencegah penipuan atau melindungi keamanan platform</li>
                    </ul>
                </section>
                
                <!-- Data Security -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">5. Keamanan Data</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Enkripsi</h3>
                            <p class="text-gray-600 text-sm">Semua data sensitif dienkripsi menggunakan teknologi SSL/TLS</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Akses Terbatas</h3>
                            <p class="text-gray-600 text-sm">Hanya personel yang berwenang yang dapat mengakses data pribadi</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Monitoring</h3>
                            <p class="text-gray-600 text-sm">Sistem keamanan dipantau 24/7 untuk mencegah pelanggaran</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Backup</h3>
                            <p class="text-gray-600 text-sm">Data dicadangkan secara teratur di server yang aman</p>
                        </div>
                    </div>
                </section>
                
                <!-- Your Rights -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">6. Hak-Hak Anda</h2>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Akses Data</h3>
                                <p class="text-gray-600 text-sm">Anda dapat meminta salinan data pribadi yang kami miliki</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Perbaikan Data</h3>
                                <p class="text-gray-600 text-sm">Anda dapat meminta perbaikan data yang tidak akurat</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Penghapusan Data</h3>
                                <p class="text-gray-600 text-sm">Anda dapat meminta penghapusan data pribadi Anda</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Portabilitas Data</h3>
                                <p class="text-gray-600 text-sm">Anda dapat meminta transfer data ke platform lain</p>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Cookies -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">7. Cookies dan Teknologi Pelacakan</h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Kami menggunakan cookies dan teknologi serupa untuk meningkatkan pengalaman pengguna, 
                        menganalisis penggunaan platform, dan menyediakan konten yang relevan.
                    </p>
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <h3 class="font-semibold text-yellow-900 mb-2">Jenis Cookies yang Kami Gunakan:</h3>
                        <ul class="list-disc list-inside text-yellow-800 space-y-1 ml-4">
                            <li><strong>Essential Cookies:</strong> Diperlukan untuk fungsi dasar platform</li>
                            <li><strong>Analytics Cookies:</strong> Membantu kami memahami bagaimana platform digunakan</li>
                            <li><strong>Marketing Cookies:</strong> Digunakan untuk menampilkan iklan yang relevan</li>
                        </ul>
                    </div>
                </section>
                
                <!-- Children's Privacy -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">8. Privasi Anak-Anak</h2>
                    <p class="text-gray-600 leading-relaxed">
                        Platform TheSkills tidak ditujukan untuk anak-anak di bawah 13 tahun. Kami tidak secara 
                        sengaja mengumpulkan informasi pribadi dari anak-anak di bawah 13 tahun. Jika kami 
                        mengetahui bahwa kami telah mengumpulkan informasi dari anak di bawah 13 tahun, 
                        kami akan segera menghapus informasi tersebut.
                    </p>
                </section>
                
                <!-- Changes to Policy -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">9. Perubahan Kebijakan</h2>
                    <p class="text-gray-600 leading-relaxed">
                        Kami dapat memperbarui Kebijakan Privasi ini dari waktu ke waktu. Perubahan material 
                        akan diberitahukan melalui email atau pemberitahuan di platform. Kami mendorong Anda 
                        untuk meninjau kebijakan ini secara berkala.
                    </p>
                </section>
                
                <!-- Contact Information -->
                <section>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">10. Informasi Kontak</h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Jika Anda memiliki pertanyaan tentang Kebijakan Privasi ini atau ingin menggunakan 
                        hak-hak Anda, silakan hubungi kami:
                    </p>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-2">Email</h3>
                                <p class="text-gray-600">privacy@theskills.com</p>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-2">Alamat</h3>
                                <p class="text-gray-600">Ruko Pesona Regency, Jl. Slamet Riyadi RT.001/RW.015, Jember, Jawa Timur<br>
                                    68121<br>
                                    Indonesia</p>
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
        <h2 class="text-3xl font-bold text-white mb-4">Punya Pertanyaan?</h2>
        <p class="text-xl text-blue-100 mb-8">
            Tim privacy kami siap membantu menjawab pertanyaan Anda tentang kebijakan privasi
        </p>
        <a href="{{ route('contact') }}" 
           class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
            <i class="fas fa-envelope mr-2"></i>
            Hubungi Tim Privacy
        </a>
    </div>
</div>
@endsection
