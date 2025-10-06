<x-app-layout>
    <!-- Header Banner dengan Background -->
    <div class="relative h-64 bg-gradient-to-r from-purple-600 to-blue-600 overflow-hidden">
        <!-- Pattern Background -->
        <div class="absolute inset-0">
            <svg class="w-full h-full text-white/10" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 0 L50 100 L100 0 Z" fill="currentColor"></path>
                <path d="M0 100 L50 0 L100 100 Z" fill="currentColor"></path>
            </svg>
        </div>

        <!-- Cover Photo -->
        @if($instructor->cover_photo)
            <img src="{{ Storage::url($instructor->cover_photo) }}" 
                 class="absolute inset-0 w-full h-full object-cover mix-blend-overlay"
                 alt="Cover Photo">
        @endif
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-32">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6">
                <!-- Profile Header -->
                <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                    <!-- Profile Image -->
                    <div class="relative">
                        @if($instructor->profile_photo)
                            <img src="{{ Storage::url($instructor->profile_photo) }}" 
                                 class="w-32 h-32 rounded-full border-4 border-white shadow-lg"
                                 alt="{{ $instructor->name }}">
                        @else
                            <div class="w-32 h-32 rounded-full bg-gray-200 border-4 border-white shadow-lg flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Profile Info -->
                    <div class="flex-1 text-center md:text-left">
                        <h1 class="text-2xl font-bold text-gray-900">{{ $instructor->name }}</h1>
                        <p class="text-gray-600">{{ $instructor->email }}</p>
                        
                        <!-- Stats -->
                        <div class="mt-4 flex flex-wrap justify-center md:justify-start gap-6">
                            <div>
                                <p class="text-2xl font-bold text-gray-900">{{ $instructor->courses_count }}</p>
                                <p class="text-sm text-gray-500">Kursus</p>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900">{{ $instructor->students_count }}</p>
                                <p class="text-sm text-gray-500">Siswa</p>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900">{{ $instructor->reviews_count ?? 0 }}</p>
                                <p class="text-sm text-gray-500">Ulasan</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bio -->
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Tentang Saya</h3>
                    <p class="text-gray-600">{{ $instructor->bio ?? 'Bio data is empty' }}</p>
                </div>

                <!-- Courses -->
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Kursus</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($instructor->courses as $course)
                            <div class="bg-white border rounded-lg overflow-hidden">
                                <!-- Course Thumbnail -->
                                <div class="aspect-video bg-gray-100">
                                    @if($course->thumbnail)
                                        <img src="{{ $course->thumbnail_url }}" 
                                             class="w-full h-full object-cover"
                                             alt="{{ $course->title }}">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Course Info -->
                                <div class="p-4">
                                    <h4 class="font-semibold text-gray-900 mb-2">{{ $course->title }}</h4>
                                    <p class="text-sm text-gray-600 mb-4">{{ Str::limit($course->description, 100) }}</p>
                                    
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-500">{{ $course->students_count }} siswa</span>
                                        <span class="text-sm font-semibold text-gray-900">Rp {{ number_format($course->price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-8">
                                <p class="text-gray-500">Belum ada kursus yang dibuat</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 