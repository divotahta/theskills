@extends('layouts.public')

@section('title', 'Kursus - TheSkills')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Kursus Online</h1>
            <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                Temukan kursus yang tepat untuk mengembangkan skill dan pengetahuan Anda
            </p>
                        </div>
                </div>
</section>

<!-- Courses Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Search and Filter -->
        <div class="mb-8">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div class="md:col-span-2">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Cari Kursus</label>
                    <div class="relative">
                            <input type="text" 
                                   id="search" 
                                   placeholder="Masukkan kata kunci..."
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>

                    <!-- Category Filter -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select id="category" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Level Filter -->
                    <div>
                        <label for="level" class="block text-sm font-medium text-gray-700 mb-2">Level</label>
                        <select id="level" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua Level</option>
                            @foreach($courseLevels as $level)
                                <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

    <!-- Courses Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($courses as $course)
                <div  class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow group">
                    <!-- Course Thumbnail -->
                    <a href="{{ route('courses.show', $course->id) }}">
                    <div class="aspect-video bg-gradient-to-br from-blue-500 to-purple-600 relative overflow-hidden">
                        @if($course->thumbnail)
                            <img src="{{ asset('storage/' . $course->thumbnail) }}" 
                                 alt="{{ $course->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center">
                                <i class="fas fa-graduation-cap text-6xl text-white opacity-80"></i>
                            </div>
                        @endif
                        
                        <!-- Course Level Badge -->
                        @if($course->courseLevel)
                            <div class="absolute top-4 left-4 bg-white bg-opacity-90 text-gray-900 px-3 py-1 rounded-full text-sm font-semibold">
                                {{ $course->courseLevel->name }}
                            </div>
                        @endif

                        <!-- New Badge -->
                        @if($course->created_at->isToday() || $course->created_at->isYesterday())
                            <div class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                <i class="fas fa-sparkles mr-1"></i>
                                Baru
                            </div>
                        @endif

                        <!-- Public/Private Badge -->
                        <div class="absolute bottom-4 right-4">
                            @if($course->is_public)
                                <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs font-semibold">
                                    <i class="fas fa-globe mr-1"></i>
                                    Public
                                </span>
                            @else
                                <span class="bg-gray-500 text-white px-2 py-1 rounded-full text-xs font-semibold">
                                    <i class="fas fa-lock mr-1"></i>
                                    Private
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Course Content -->
                    <div class="p-6">
                        <!-- Category -->
                        @if($course->category)
                            <div class="text-sm text-blue-600 font-medium mb-2">
                                {{ $course->category->name }}
                            </div>
                        @endif

                        <!-- Title -->
                        <h3 class="text-xl font-semibold text-gray-900 mb-2 line-clamp-2">
                            {{ $course->title }}
                        </h3>

                        <!-- Description -->
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ Str::limit($course->description, 120) }}
                        </p>

                        <!-- Instructor -->
                        <div class="flex items-center mb-4">
                            <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                                @if($course->instructor->avatar)
                                    <img src="{{ asset('storage/' . $course->instructor->avatar) }}" 
                                         alt="{{ $course->instructor->name }}"
                                         class="w-8 h-8 rounded-full object-cover">
                                @else
                                    <i class="fas fa-user text-gray-600 text-sm"></i>
                                @endif
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $course->instructor->name }}</div>
                                <div class="text-xs text-gray-500">Instruktur</div>
                            </div>
                        </div>

                        <!-- Course Stats -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <div class="flex items-center">
                                    <i class="fas fa-users mr-1"></i>
                                    <span>{{ $course->enrollments_count ?? 0 }} siswa</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-clock mr-1"></i>
                                    <span>{{ $course->topics_count ?? 0 }} topik</span>
                                </div>
                            </div>
                            </div>

                        <!-- Price and Action -->
                        <div class="flex items-center justify-between">
                            <div class="text-2xl font-bold text-blue-600">
                                Rp {{ number_format($course->price, 0, ',', '.') }}
                            </div>

                            @auth
                                @if(Auth::user()->role === 'student')
                                    <a href="{{ route('student.courses.show', $course) }}" 
                                       class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors">
                                        Lihat Detail
                                    </a>
                                @elseif(Auth::user()->role === 'instructor' && Auth::id() == $course->instructor_id)
                                    <a href="{{ route('instructor.courses.show', $course) }}" 
                                       class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-green-700 transition-colors">
                                        Kelola Kursus
                                    </a>
                                @else
                                    <a href="{{ route('courses.show', $course) }}" 
                                       class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors">
                                Lihat Detail
                            </a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" 
                                   class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors">
                                    Login untuk Akses
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="col-span-full text-center py-16">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-graduation-cap text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-900 mb-4">Belum Ada Kursus</h3>
                    <p class="text-gray-600 mb-8">Saat ini belum ada kursus yang tersedia. Silakan kembali lagi nanti.</p>
                    @auth
                        @if(Auth::user()->role === 'instructor')
                            <a href="{{ route('instructor.courses.create') }}" 
                               class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                                Buat Kursus Pertama
                            </a>
                        @endif
                    @endauth
                </div>
            @endforelse
            </div>

            <!-- Pagination -->
        @if($courses->hasPages())
            <div class="mt-12">
                {{ $courses->links() }}
            </div>
        @endif
        </div>
    </section>

<!-- CTA Section -->
@guest
<section class="py-16 bg-gradient-to-r from-blue-600 to-purple-600 text-white">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">
            Siap Memulai Perjalanan Belajar?
        </h2>
        <p class="text-xl mb-8 text-blue-100">
            Daftar sekarang untuk mengakses semua kursus dan mulai mengembangkan skill Anda
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" 
               class="bg-yellow-400 text-gray-900 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-yellow-300 transition-colors">
                <i class="fas fa-user-plus mr-2"></i>
                Daftar Sekarang
            </a>
            <a href="{{ route('instructor.register') }}" 
               class="border-2 border-white text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-white hover:text-gray-900 transition-colors">
                <i class="fas fa-chalkboard-teacher mr-2"></i>
                Jadi Instruktur
            </a>
                        </div>
                    </div>
</section>
@endguest
@endsection

@push('scripts')
<script>
    // Search functionality
    document.getElementById('search').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const courseCards = document.querySelectorAll('.bg-white.rounded-xl.shadow-lg');
        
        courseCards.forEach(card => {
            const title = card.querySelector('h3').textContent.toLowerCase();
            const description = card.querySelector('p').textContent.toLowerCase();
            
            if (title.includes(searchTerm) || description.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });

    // Category filter
    document.getElementById('category').addEventListener('change', function() {
        const selectedCategory = this.value;
        const courseCards = document.querySelectorAll('.bg-white.rounded-xl.shadow-lg');
        
        courseCards.forEach(card => {
            if (selectedCategory === '' || card.dataset.category === selectedCategory) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });

    // Level filter
    document.getElementById('level').addEventListener('change', function() {
        const selectedLevel = this.value;
        const courseCards = document.querySelectorAll('.bg-white.rounded-xl.shadow-lg');
        
        courseCards.forEach(card => {
            if (selectedLevel === '' || card.dataset.level === selectedLevel) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
</script>
@endpush