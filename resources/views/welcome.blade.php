<x-main-layout>
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-4xl md:text-5xl font-bold mb-6">
                        Belajar Coding & Matematika untuk Anak di Jember
                    </h1>
                    <p class="text-lg md:text-xl mb-8 text-white/80">
                        Kembangkan kreativitas dan logika anak melalui pembelajaran coding dan matematika yang menyenangkan
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('courses.index') }}" 
                           class="px-6 py-3 bg-white text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition">
                            Lihat Kelas
                        </a>
                        <a href="#contact" 
                           class="px-6 py-3 bg-transparent border-2 border-white rounded-lg font-semibold hover:bg-white/10 transition">
                            Hubungi Kami
                        </a>
                    </div>
                </div>
                <div class="hidden lg:block ">
                    <img src="{{ asset('images/homepage.png') }}" alt="Kids Learning" class="h-[450px] ">
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Mengapa Memilih TheSkills.id?</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Kami menyediakan pembelajaran yang interaktif dan menyenangkan untuk anak-anak
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 bg-gray-50 rounded-xl">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Kurikulum Terstruktur</h3>
                    <p class="text-gray-600">Materi pembelajaran yang disesuaikan dengan kemampuan dan usia anak</p>
                </div>

                <div class="p-6 bg-gray-50 rounded-xl">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Instruktur Berpengalaman</h3>
                    <p class="text-gray-600">Tim pengajar yang profesional dan berpengalaman dalam mengajar anak-anak</p>
                </div>

                <div class="p-6 bg-gray-50 rounded-xl">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Pembelajaran Interaktif</h3>
                    <p class="text-gray-600">Metode belajar yang menyenangkan dengan praktik langsung dan games</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Programs Section -->
    <div class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Program Pembelajaran</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Pilih program pembelajaran sesuai minat dan kebutuhan anak
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-xl overflow-hidden shadow-sm">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Kelas Coding</h3>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Scratch Programming untuk Pemula
                            </li>
                            <li class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Python untuk Anak
                            </li>
                            <li class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Web Development Dasar
                            </li>
                        </ul>
                        <a href="{{ route('courses.index') }}" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-xl overflow-hidden shadow-sm">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Kelas Matematika</h3>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Matematika Dasar SD
                            </li>
                            <li class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Persiapan Olimpiade
                            </li>
                            <li class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Problem Solving
                            </li>
                        </ul>
                        <a href="{{ route('courses.index') }}" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div id="contact" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Hubungi Kami</h2>
                    <p class="text-lg text-gray-600 mb-8">
                        Punya pertanyaan? Silakan hubungi kami melalui kontak di bawah ini
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-blue-600 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <div>
                                <h3 class="font-semibold text-gray-900">Alamat</h3>
                                <p class="text-gray-600">Jl. Contoh No. 123, Jember, Jawa Timur</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-blue-600 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <h3 class="font-semibold text-gray-900">Email</h3>
                                <p class="text-gray-600">info@theskills.id</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-blue-600 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <div>
                                <h3 class="font-semibold text-gray-900">Telepon/WhatsApp</h3>
                                <p class="text-gray-600">+62 812-3456-7890</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-xl p-6">
                    <form class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                            <textarea rows="4" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"></textarea>
                        </div>
                        <button type="submit" class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
