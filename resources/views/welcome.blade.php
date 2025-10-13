@extends('layouts.public')

@section('title', 'TheSkills - Platform Pembelajaran Online Terbaik')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-700 text-white overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <svg class="absolute inset-0 w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <defs>
                <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                    <path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100" height="100" fill="url(#grid)" />
                            </svg>
                </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Content -->
            <div class="space-y-8">
                <div class="space-y-4">
                    <h1 class="text-4xl md:text-6xl font-bold leading-tight">
                        Belajar Skill Baru
                        <span class="text-yellow-400">Dimana Saja</span>
                    </h1>
                    <p class="text-xl md:text-2xl text-blue-100 leading-relaxed">
                        Platform pembelajaran online terbaik dengan instruktur berpengalaman. 
                        Raih impian Anda dengan skill yang tepat.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    @auth
                        @if(Auth::user()->role === 'student')
                            <a href="{{ route('student.dashboard') }}" 
                               class="bg-yellow-400 text-gray-900 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-yellow-300 transition-colors text-center">
                                <i class="fas fa-tachometer-alt mr-2"></i>
                            Dashboard
                        </a>
                        @elseif(Auth::user()->role === 'instructor')
                            <a href="{{ route('instructor.dashboard') }}" 
                               class="bg-yellow-400 text-gray-900 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-yellow-300 transition-colors text-center">
                                <i class="fas fa-chalkboard-teacher mr-2"></i>
                                Instructor Dashboard
                            </a>
                        @elseif(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" 
                               class="bg-yellow-400 text-gray-900 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-yellow-300 transition-colors text-center">
                                <i class="fas fa-cogs mr-2"></i>
                                Admin Dashboard
                            </a>
                        @endif
                    @else
                        <a href="{{ route('register') }}" 
                           class="bg-yellow-400 text-gray-900 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-yellow-300 transition-colors text-center">
                            <i class="fas fa-user-plus mr-2"></i>
                            Daftar Sekarang
                        </a>
                    @endauth
                    <a href="{{ route('courses.index') }}" 
                       class="border-2 border-white text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-white hover:text-gray-900 transition-colors text-center">
                        <i class="fas fa-play mr-2"></i>
                        Lihat Kursus
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-8 pt-8">
                            <div class="text-center">
                        <div class="text-3xl font-bold text-yellow-400">500+</div>
                        <div class="text-blue-100">Kursus</div>
                            </div>
                            <div class="text-center">
                        <div class="text-3xl font-bold text-yellow-400">10K+</div>
                        <div class="text-blue-100">Siswa</div>
                            </div>
                            <div class="text-center">
                        <div class="text-3xl font-bold text-yellow-400">50+</div>
                        <div class="text-blue-100">Instruktur</div>
                    </div>
                </div>
            </div>

            <!-- Hero Image -->
            <div class="relative">
                <div class="relative z-10">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" 
                         alt="Students learning online" 
                         class="rounded-2xl shadow-2xl">
                            </div>
                <!-- Floating Cards -->
                <div class="absolute -top-4 -left-4 bg-white rounded-lg p-4 shadow-lg z-20">
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        <span class="text-sm font-medium text-gray-700">Live Class</span>
                            </div>
                        </div>
                <div class="absolute -bottom-4 -right-4 bg-white rounded-lg p-4 shadow-lg z-20">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-star text-yellow-400"></i>
                        <span class="text-sm font-medium text-gray-700">4.9 Rating</span>
                        </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
    </section>

<!-- Features Section -->
<section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Mengapa Memilih TheSkills?
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Platform pembelajaran online yang dirancang khusus untuk memberikan pengalaman belajar terbaik
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="text-center group">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-blue-200 transition-colors">
                    <i class="fas fa-chalkboard-teacher text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Instruktur Berpengalaman</h3>
                <p class="text-gray-600">
                    Belajar dari instruktur yang sudah berpengalaman di bidangnya dengan metode pengajaran yang terbukti efektif
                </p>
            </div>
            
            <!-- Feature 2 -->
            <div class="text-center group">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-purple-200 transition-colors">
                    <i class="fas fa-laptop text-2xl text-purple-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Belajar Fleksibel</h3>
                <p class="text-gray-600">
                    Akses materi pembelajaran kapan saja dan dimana saja sesuai dengan jadwal Anda
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="text-center group">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-green-200 transition-colors">
                    <i class="fas fa-certificate text-2xl text-green-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Sertifikat Resmi</h3>
                <p class="text-gray-600">
                    Dapatkan sertifikat resmi setelah menyelesaikan kursus yang dapat meningkatkan CV Anda
                </p>
            </div>
            </div>
        </div>
    </section>

<!-- Popular Courses Section -->
<section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Kursus Populer
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Pilih dari berbagai kursus berkualitas tinggi yang dirancang untuk mengembangkan skill Anda
            </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Course Card 1 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                <div class="aspect-video bg-gradient-to-br from-blue-500 to-purple-600 relative">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <i class="fas fa-code text-6xl text-white opacity-80"></i>
                            </div>
                    <div class="absolute top-4 right-4 bg-yellow-400 text-gray-900 px-3 py-1 rounded-full text-sm font-semibold">
                        Populer
                            </div>
                        </div>
                        <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Web Development</h3>
                    <p class="text-gray-600 mb-4">Pelajari HTML, CSS, JavaScript, dan framework modern untuk menjadi web developer profesional</p>
                    <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                            <i class="fas fa-star text-yellow-400"></i>
                            <span class="text-sm text-gray-600">4.9 (120 reviews)</span>
                        </div>
                        <span class="text-lg font-bold text-blue-600">Rp 299.000</span>
                    </div>
                </div>
            </div>

            <!-- Course Card 2 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                <div class="aspect-video bg-gradient-to-br from-green-500 to-teal-600 relative">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <i class="fas fa-chart-line text-6xl text-white opacity-80"></i>
            </div>
                    <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        Terbaru
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Data Science</h3>
                    <p class="text-gray-600 mb-4">Kuasai Python, Machine Learning, dan Data Analysis untuk karir di bidang data science</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-star text-yellow-400"></i>
                            <span class="text-sm text-gray-600">4.8 (95 reviews)</span>
                    </div>
                        <span class="text-lg font-bold text-blue-600">Rp 399.000</span>
                    </div>
                </div>
            </div>

            <!-- Course Card 3 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                <div class="aspect-video bg-gradient-to-br from-pink-500 to-rose-600 relative">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <i class="fas fa-palette text-6xl text-white opacity-80"></i>
                                </div>
                    <div class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                        Terlaris
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">UI/UX Design</h3>
                    <p class="text-gray-600 mb-4">Pelajari prinsip desain, Figma, dan user experience untuk menjadi UI/UX designer</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-star text-yellow-400"></i>
                            <span class="text-sm text-gray-600">4.9 (150 reviews)</span>
                        </div>
                        <span class="text-lg font-bold text-blue-600">Rp 249.000</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('courses.index') }}" 
               class="bg-blue-600 text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-blue-700 transition-colors">
                Lihat Semua Kursus
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600 text-white">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">
            Siap Memulai Perjalanan Belajar Anda?
        </h2>
        <p class="text-xl mb-8 text-blue-100">
            Bergabunglah dengan ribuan siswa yang sudah merasakan manfaat pembelajaran online di TheSkills
        </p>
        @guest
            <a href="{{ route('register') }}" 
               class="bg-yellow-400 text-gray-900 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-yellow-300 transition-colors">
                Daftar Sekarang - Gratis!
            </a>
        @else
            <a href="{{ route('courses.index') }}" 
               class="bg-yellow-400 text-gray-900 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-yellow-300 transition-colors">
                Jelajahi Kursus
            </a>
        @endguest
        </div>
    </section>

<!-- About Section -->
<section id="about" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                    Tentang TheSkills
                </h2>
                <p class="text-lg text-gray-600 mb-6">
                    TheSkills adalah platform pembelajaran online yang didedikasikan untuk membantu setiap individu 
                    mengembangkan skill dan pengetahuan yang dibutuhkan di era digital ini.
                </p>
                <p class="text-lg text-gray-600 mb-8">
                    Dengan instruktur berpengalaman, materi berkualitas tinggi, dan sistem pembelajaran yang fleksibel, 
                    kami berkomitmen untuk memberikan pengalaman belajar terbaik bagi setiap siswa.
                </p>
                <div class="grid grid-cols-2 gap-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-blue-600 mb-2">500+</div>
                        <div class="text-gray-600">Kursus Tersedia</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-blue-600 mb-2">10K+</div>
                        <div class="text-gray-600">Siswa Aktif</div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" 
                     alt="About TheSkills" 
                     class="rounded-xl shadow-lg">
            </div>
        </div>
                        </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Hubungi Kami
            </h2>
            <p class="text-xl text-gray-600">
                Ada pertanyaan? Tim support kami siap membantu Anda
            </p>
                        </div>
                
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-envelope text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Email</h3>
                <p class="text-gray-600">support@theskills.com</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-phone text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Telepon</h3>
                <p class="text-gray-600">+62 21 1234 5678</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-map-marker-alt text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Alamat</h3>
                <p class="text-gray-600">Jakarta, Indonesia</p>
            </div>
        </div>
    </div>
</section>
@endsection