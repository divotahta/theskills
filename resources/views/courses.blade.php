<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kursus Seru untuk Anak-Anak - TheSkills Kids</title>
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
                <div class="flex-1 max-w-2xl mx-8 hidden md:block">
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
                    <a href="/courses" class="text-gray-700 hover:text-gray-900 font-medium">Kursus</a>
                    <a href="#" class="text-gray-700 hover:text-gray-900 font-medium">Kategori</a>
                    <a href="#" class="text-gray-700 hover:text-gray-900 font-medium">Tentang</a>
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
    <section class="bg-gradient-to-br from-pink-100 via-purple-50 to-blue-100 py-12 relative overflow-hidden">
        <!-- Floating Elements -->
        <div class="absolute top-5 left-5 text-4xl opacity-30 animate-bounce">🎈</div>
        <div class="absolute top-10 right-10 text-3xl opacity-25 animate-pulse">🌟</div>
        <div class="absolute bottom-5 left-10 text-3xl opacity-30 animate-bounce delay-1000">🎨</div>
        <div class="absolute bottom-10 right-5 text-4xl opacity-25 animate-pulse delay-500">🚀</div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12">
                <h1 class="text-5xl font-bold text-gray-900 mb-4">🎨 Kursus Seru untuk Anak-Anak</h1>
                <p class="text-xl text-gray-600 mb-8">Temukan dunia belajar yang menyenangkan dengan ribuan kursus menarik!</p>
            </div>

            <!-- Filter Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
                        <input type="text" placeholder="Cari kursus..." 
                               class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">🎨 Kategori</label>
                        <select class="w-full border-gray-300 rounded-lg focus:ring-pink-500 focus:border-pink-500">
                            <option value="">Semua Kategori</option>
                            <option value="menggambar">🎨 Menggambar & Melukis</option>
                            <option value="matematika">🔢 Matematika Seru</option>
                            <option value="bahasa-inggris">🇺🇸 Bahasa Inggris</option>
                            <option value="sains">🧪 Sains & Eksperimen</option>
                            <option value="musik">🎵 Musik & Bernyanyi</option>
                            <option value="olahraga">⚽ Olahraga & Gerak</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">👶 Usia</label>
                        <select class="w-full border-gray-300 rounded-lg focus:ring-pink-500 focus:border-pink-500">
                            <option value="">Semua Usia</option>
                            <option value="3-5">👶 3-5 tahun</option>
                            <option value="6-8">🧒 6-8 tahun</option>
                            <option value="9-12">👦 9-12 tahun</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">💰 Harga</label>
                        <select class="w-full border-gray-300 rounded-lg focus:ring-pink-500 focus:border-pink-500">
                            <option value="">Semua Harga</option>
                            <option value="free">🆓 Gratis</option>
                            <option value="paid">💳 Berbayar</option>
                        </select>
                    </div>
                    
                    <div class="flex items-end">
                        <button class="w-full bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg font-medium transform hover:scale-105 transition-all">
                            🔍 Cari Kursus
                        </button>
                    </div>
                </div>
            </div>

            <!-- Results Count -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Hasil Pencarian</h2>
                    <p class="text-gray-600">Menampilkan 1-12 dari 500+ kursus</p>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">Urutkan berdasarkan:</span>
                    <select class="border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="relevance">Relevansi</option>
                        <option value="rating">Rating</option>
                        <option value="newest">Terbaru</option>
                        <option value="price-low">Harga Terendah</option>
                        <option value="price-high">Harga Tertinggi</option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    <!-- Courses Grid -->
    <section class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @php
                    $courses = [
                        [
                            'title' => 'Menggambar Hewan Lucu untuk Anak',
                            'instructor' => 'Bu Sarah yang Ramah',
                            'rating' => 4.9,
                            'students' => 8500,
                            'price' => 99000,
                            'originalPrice' => 199000,
                            'thumbnail' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=400',
                            'badge' => 'Favorit',
                            'duration' => '2 jam',
                            'level' => '3-8 tahun'
                        ],
                        [
                            'title' => 'Matematika Seru dengan Permainan',
                            'instructor' => 'Pak Budi yang Sabar',
                            'rating' => 4.8,
                            'students' => 7200,
                            'price' => 149000,
                            'originalPrice' => 299000,
                            'thumbnail' => 'https://images.unsplash.com/photo-1509228468518-180dd4864904?w=400',
                            'badge' => 'Seru',
                            'duration' => '3 jam',
                            'level' => '5-10 tahun'
                        ],
                        [
                            'title' => 'Belajar Bahasa Inggris dengan Lagu',
                            'instructor' => 'Miss Lisa yang Ceria',
                            'rating' => 4.9,
                            'students' => 6800,
                            'price' => 179000,
                            'originalPrice' => 359000,
                            'thumbnail' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=400',
                            'badge' => 'Populer',
                            'duration' => '4 jam',
                            'level' => '4-12 tahun'
                        ],
                        [
                            'title' => 'Eksperimen Sains yang Menakjubkan',
                            'instructor' => 'Profesor Kecil',
                            'rating' => 4.7,
                            'students' => 5600,
                            'price' => 199000,
                            'originalPrice' => 399000,
                            'thumbnail' => 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?w=400',
                            'badge' => 'Wow',
                            'duration' => '5 jam',
                            'level' => '6-12 tahun'
                        ],
                        [
                            'title' => 'Bernyanyi dan Menari Bersama',
                            'instructor' => 'Bu Maya yang Menyenangkan',
                            'rating' => 4.8,
                            'students' => 4900,
                            'price' => 129000,
                            'originalPrice' => 259000,
                            'thumbnail' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=400',
                            'badge' => 'Musik',
                            'duration' => '2 jam',
                            'level' => '3-8 tahun'
                        ],
                        [
                            'title' => 'Olahraga Seru di Rumah',
                            'instructor' => 'Coach Rudi yang Energik',
                            'rating' => 4.6,
                            'students' => 3800,
                            'price' => 99000,
                            'originalPrice' => 199000,
                            'thumbnail' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=400',
                            'badge' => 'Aktif',
                            'duration' => '1.5 jam',
                            'level' => '4-10 tahun'
                        ],
                        [
                            'title' => 'Membuat Kerajinan Tangan Kreatif',
                            'instructor' => 'Bu Sari yang Kreatif',
                            'rating' => 4.9,
                            'students' => 6100,
                            'price' => 119000,
                            'originalPrice' => 239000,
                            'thumbnail' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=400',
                            'badge' => 'Kreatif',
                            'duration' => '3 jam',
                            'level' => '5-12 tahun'
                        ],
                        [
                            'title' => 'Coding untuk Anak dengan Scratch',
                            'instructor' => 'Pak Andi yang Teknologi',
                            'rating' => 4.7,
                            'students' => 4200,
                            'price' => 249000,
                            'originalPrice' => 499000,
                            'thumbnail' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=400',
                            'badge' => 'Teknologi',
                            'duration' => '6 jam',
                            'level' => '8-12 tahun'
                        ]
                    ];
                @endphp

                @foreach($courses as $course)
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
                            <div class="absolute bottom-3 left-3">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-black/70 text-white">
                                    {{ $course['duration'] }}
                                </span>
                            </div>
                        </div>

                        <!-- Course Content -->
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">{{ $course['title'] }}</h3>
                            <p class="text-sm text-gray-600 mb-2">{{ $course['instructor'] }}</p>
                            
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

                            <!-- Level -->
                            <div class="mb-3">
                                <span class="inline-flex px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                    {{ $course['level'] }}
                                </span>
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
                            <a href="/courses/{{ strtolower(str_replace(' ', '-', $course['title'])) }}" 
                               class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-center font-medium transition-colors block">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-12">
                <nav class="flex items-center space-x-2">
                    <button class="px-3 py-2 text-gray-500 hover:text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <button class="px-3 py-2 bg-blue-600 text-white rounded-lg">1</button>
                    <button class="px-3 py-2 text-gray-700 hover:text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-50">2</button>
                    <button class="px-3 py-2 text-gray-700 hover:text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-50">3</button>
                    <button class="px-3 py-2 text-gray-700 hover:text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-50">4</button>
                    <button class="px-3 py-2 text-gray-700 hover:text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-50">5</button>
                    <button class="px-3 py-2 text-gray-500 hover:text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </nav>
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
