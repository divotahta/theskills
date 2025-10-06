<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TheSkills') }} - Belajar Seru untuk Anak-Anak</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center shadow-lg">
                            <span class="text-white font-bold text-xl">🎓</span>
                        </div>
                        <span class="ml-3 text-2xl font-bold text-gray-900">TheSkills Kids</span>
                    </a>
                </div>

                <!-- Search Bar -->
                <div class="flex-1 max-w-lg mx-8 hidden md:block">
                    <div class="relative">
                        <input type="text" placeholder="Cari kursus apa saja..." 
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/courses" class="text-gray-700 hover:text-pink-600 font-medium">🎨 Kursus</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 font-medium">🌟 Kategori</a>
                    <a href="#" class="text-gray-700 hover:text-green-600 font-medium">👨‍👩‍👧‍👦 Tentang</a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900 font-medium">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-pink-400 via-purple-500 to-indigo-600 text-white relative overflow-hidden">
        <!-- Floating Elements -->
        <div class="absolute top-10 left-10 text-6xl opacity-20 animate-bounce">🌟</div>
        <div class="absolute top-20 right-20 text-4xl opacity-30 animate-pulse">🎈</div>
        <div class="absolute bottom-20 left-20 text-5xl opacity-25 animate-bounce delay-1000">🎨</div>
        <div class="absolute bottom-10 right-10 text-4xl opacity-20 animate-pulse delay-500">🚀</div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-5xl font-bold mb-6 leading-tight">
                        Belajar Seru dengan 
                        <span class="text-yellow-300">Kursus Online</span> 🎓
                    </h1>
                    <p class="text-xl mb-8 text-pink-100">
                        Temukan dunia belajar yang menyenangkan! Ribuan kursus menarik untuk anak-anak 
                        dengan instruktur yang ramah dan sabar. Belajar sambil bermain! 🎮
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/courses" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-8 py-4 rounded-full font-bold text-lg transition-all transform hover:scale-105 shadow-lg">
                            🎨 Mulai Belajar Seru!
                        </a>
                        <a href="#" class="border-2 border-white text-white hover:bg-white hover:text-purple-600 px-8 py-4 rounded-full font-bold text-lg transition-all transform hover:scale-105">
                            🎬 Lihat Demo
                        </a>
                                </div>
                                        </div>
                <div class="relative">
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div class="text-center">
                                <div class="text-3xl font-bold">10K+</div>
                                <div class="text-sm text-pink-100">👶 Anak Hebat</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold">500+</div>
                                <div class="text-sm text-pink-100">🎨 Kursus Seru</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold">50+</div>
                                <div class="text-sm text-pink-100">👨‍🏫 Guru Ramah</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold">4.8</div>
                                <div class="text-sm text-pink-100">⭐ Rating</div>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="text-sm text-pink-100 mb-2">Bergabung dengan ribuan anak hebat lainnya! 🌟</div>
                            <div class="flex justify-center space-x-1">
                                @for($i = 0; $i < 5; $i++)
                                    <span class="text-2xl">⭐</span>
                                @endfor
                            </div>
                        </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
    </section>

    <!-- Categories Section -->
    <section class="py-16 bg-gradient-to-br from-yellow-50 to-pink-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">🌟 Kategori Seru untuk Anak-Anak</h2>
                <p class="text-gray-600 text-lg">Temukan kursus yang sesuai dengan hobi dan minat si kecil!</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                @php
                    $categories = [
                        ['name' => 'Menggambar & Melukis', 'icon' => '🎨', 'color' => 'bg-pink-100 hover:bg-pink-200'],
                        ['name' => 'Matematika Seru', 'icon' => '🔢', 'color' => 'bg-blue-100 hover:bg-blue-200'],
                        ['name' => 'Bahasa Inggris', 'icon' => '🇺🇸', 'color' => 'bg-green-100 hover:bg-green-200'],
                        ['name' => 'Sains & Eksperimen', 'icon' => '🧪', 'color' => 'bg-purple-100 hover:bg-purple-200'],
                        ['name' => 'Musik & Bernyanyi', 'icon' => '🎵', 'color' => 'bg-yellow-100 hover:bg-yellow-200'],
                        ['name' => 'Olahraga & Gerak', 'icon' => '⚽', 'color' => 'bg-orange-100 hover:bg-orange-200'],
                    ];
                @endphp
                
                @foreach($categories as $category)
                    <a href="/courses?category={{ strtolower(str_replace(' ', '-', $category['name'])) }}" 
                       class="group {{ $category['color'] }} rounded-2xl p-6 text-center hover:shadow-xl transition-all duration-300 border-2 border-transparent hover:border-pink-300 transform hover:scale-105">
                        <div class="text-5xl mb-4 animate-bounce group-hover:animate-pulse">{{ $category['icon'] }}</div>
                        <h3 class="font-bold text-gray-900 group-hover:text-pink-600 transition-colors text-sm">{{ $category['name'] }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Courses Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Kursus Terpopuler</h2>
                <p class="text-gray-600 text-lg">Kursus pilihan yang paling banyak diminati</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $featuredCourses = [
                        [
                            'title' => 'Complete Web Development Bootcamp',
                            'instructor' => 'Dr. Angela Yu',
                            'rating' => 4.8,
                            'students' => 12500,
                            'price' => 299000,
                            'originalPrice' => 599000,
                            'thumbnail' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=400',
                            'badge' => 'Bestseller'
                        ],
                        [
                            'title' => 'Python for Data Science & Machine Learning',
                            'instructor' => 'Jose Portilla',
                            'rating' => 4.7,
                            'students' => 8900,
                            'price' => 199000,
                            'originalPrice' => 399000,
                            'thumbnail' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=400',
                            'badge' => 'Hot'
                        ],
                        [
                            'title' => 'UI/UX Design Masterclass',
                            'instructor' => 'Sarah Johnson',
                            'rating' => 4.9,
                            'students' => 6700,
                            'price' => 149000,
                            'originalPrice' => 299000,
                            'thumbnail' => 'https://images.unsplash.com/photo-1558655146-d09347e92766?w=400',
                            'badge' => 'New'
                        ]
                    ];
                @endphp

                @foreach($featuredCourses as $course)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow">
                        <!-- Course Thumbnail -->
                        <div class="relative h-48">
                            <img src="{{ $course['thumbnail'] }}" alt="{{ $course['title'] }}" 
                                 class="w-full h-full object-cover">
                            <div class="absolute top-3 left-3">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    {{ $course['badge'] }}
                                </span>
                            </div>
                            <div class="absolute top-3 right-3">
                                <button class="p-2 bg-white/80 rounded-full hover:bg-white transition-colors">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Course Content -->
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">{{ $course['title'] }}</h3>
                            <p class="text-sm text-gray-600 mb-3">{{ $course['instructor'] }}</p>
                            
                            <!-- Rating -->
                            <div class="flex items-center mb-3">
                                <div class="flex items-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $course['rating'] ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="ml-2 text-sm text-gray-600">{{ $course['rating'] }}</span>
                                <span class="ml-1 text-sm text-gray-500">({{ number_format($course['students']) }})</span>
                            </div>

                            <!-- Price -->
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-2">
                                    <span class="text-xl font-bold text-gray-900">Rp {{ number_format($course['price'], 0, ',', '.') }}</span>
                                    <span class="text-sm text-gray-500 line-through">Rp {{ number_format($course['originalPrice'], 0, ',', '.') }}</span>
                                </div>
                                <span class="text-sm text-green-600 font-medium">
                                    {{ round((($course['originalPrice'] - $course['price']) / $course['originalPrice']) * 100) }}% OFF
                                </span>
                            </div>

                            <!-- Action Button -->
                            <a href="/courses" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-center font-medium transition-colors block">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="/courses" class="bg-gray-900 hover:bg-gray-800 text-white px-8 py-3 rounded-lg font-medium transition-colors">
                    Lihat Semua Kursus
                </a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Mengapa Memilih TheSkills?</h2>
                <p class="text-gray-600 text-lg">Platform pembelajaran online terpercaya dengan fitur terbaik</p>
                                </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Belajar Fleksibel</h3>
                    <p class="text-gray-600">Akses kursus kapan saja, di mana saja. Sesuaikan jadwal belajar dengan aktivitas Anda.</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Sertifikat Resmi</h3>
                    <p class="text-gray-600">Dapatkan sertifikat yang diakui industri setelah menyelesaikan kursus.</p>
                                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m0-4a4 4 0 100-8 4 4 0 000 8zm8 0a4 4 0 100-8 4 4 0 000 8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Instruktur Berpengalaman</h3>
                    <p class="text-gray-600">Belajar dari praktisi dan ahli di bidangnya dengan pengalaman bertahun-tahun.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Kata Mereka</h2>
                <p class="text-gray-600 text-lg">Pengalaman belajar yang mengubah hidup</p>
                                </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                    $testimonials = [
                        [
                            'name' => 'Sarah Johnson',
                            'role' => 'Web Developer',
                            'avatar' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=100',
                            'content' => 'Kursus di TheSkills sangat membantu saya menguasai web development. Sekarang saya sudah bekerja sebagai developer di perusahaan tech terkemuka.',
                            'rating' => 5
                        ],
                        [
                            'name' => 'Ahmad Rizki',
                            'role' => 'Data Scientist',
                            'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100',
                            'content' => 'Materi data science yang disajikan sangat komprehensif dan mudah dipahami. Instruktur sangat berpengalaman dan responsive.',
                            'rating' => 5
                        ],
                        [
                            'name' => 'Lisa Chen',
                            'role' => 'UI/UX Designer',
                            'avatar' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100',
                            'content' => 'Platform yang sangat user-friendly dan konten berkualitas tinggi. Saya merekomendasikan TheSkills untuk siapa saja yang ingin belajar.',
                            'rating' => 5
                        ]
                    ];
                @endphp

                @foreach($testimonials as $testimonial)
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
                        <div class="flex items-center mb-4">
                            <img src="{{ $testimonial['avatar'] }}" alt="{{ $testimonial['name'] }}" 
                                 class="w-12 h-12 rounded-full object-cover">
                            <div class="ml-3">
                                <h4 class="font-semibold text-gray-900">{{ $testimonial['name'] }}</h4>
                                <p class="text-sm text-gray-600">{{ $testimonial['role'] }}</p>
                    </div>
                </div>
                        <div class="flex items-center mb-3">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endfor
                        </div>
                        <p class="text-gray-600 italic">"{{ $testimonial['content'] }}"</p>
                    </div>
                @endforeach
                    </div>
                </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-blue-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Siap Memulai Perjalanan Belajar Anda?</h2>
            <p class="text-xl text-blue-100 mb-8">Bergabunglah dengan ribuan siswa yang sudah merasakan manfaatnya</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/courses" class="bg-white text-blue-600 hover:bg-gray-100 px-8 py-3 rounded-lg font-semibold text-lg transition-colors">
                    Lihat Kursus
                </a>
                <a href="{{ route('register') }}" class="border-2 border-white text-white hover:bg-white hover:text-blue-600 px-8 py-3 rounded-lg font-semibold text-lg transition-colors">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-lg">T</span>
                        </div>
                        <span class="ml-2 text-xl font-bold">TheSkills</span>
                    </div>
                    <p class="text-gray-400 mb-4">Platform pembelajaran online terbaik untuk mengembangkan keterampilan Anda.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.459 8.459 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                        <div>
                    <h3 class="text-lg font-semibold mb-4">Kursus</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Web Development</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Data Science</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Mobile Apps</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Design</a></li>
                    </ul>
                        </div>
                
                        <div>
                    <h3 class="text-lg font-semibold mb-4">Perusahaan</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Karir</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Bantuan</a></li>
                    </ul>
                        </div>
                
                        <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <ul class="space-y-2">
                        <li class="text-gray-400">Email: info@theskills.com</li>
                        <li class="text-gray-400">Phone: +62 21 1234 5678</li>
                        <li class="text-gray-400">Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-400">&copy; 2024 TheSkills. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</body>
</html>