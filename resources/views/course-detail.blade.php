@extends('layouts.public')

@section('title', $course->title . ' - TheSkills')

@section('content')
<!-- Course Header -->
<section class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center">
            <!-- Course Info -->
            <div class="lg:col-span-2">
                <!-- Category -->
                @if($course->category)
                    <div class="text-blue-200 text-sm font-medium mb-2">
                        {{ $course->category->name }}
                    </div>
                @endif

                <!-- Title -->
                <h1 class="text-3xl md:text-4xl font-bold mb-4">{{ $course->title }}</h1>

                <!-- Description -->
                <p class="text-xl text-blue-100 mb-6">{{ $course->description }}</p>

                <!-- Course Stats -->
                <div class="flex flex-wrap gap-6 mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-users mr-2"></i>
                        <span>{{ $course->enrollments_count }} siswa</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-clock mr-2"></i>
                        <span>{{ $course->topics_count }} topik</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-play mr-2"></i>
                        <span>{{ $course->contents_count }} konten</span>
                    </div>
                    @if($course->courseLevel)
                        <div class="flex items-center">
                            <i class="fas fa-signal mr-2"></i>
                            <span>{{ $course->courseLevel->name }}</span>
                        </div>
                    @endif
                </div>

                <!-- Instructor -->
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-4">
                        @if($course->instructor->avatar)
                            <img src="{{ asset('storage/' . $course->instructor->avatar) }}" 
                                 alt="{{ $course->instructor->name }}"
                                 class="w-12 h-12 rounded-full object-cover">
                        @else
                            <i class="fas fa-user text-white text-xl"></i>
                        @endif
                    </div>
                    <div>
                        <div class="text-lg font-semibold">{{ $course->instructor->name }}</div>
                        <div class="text-blue-200">Instruktur</div>
                    </div>
                </div>
            </div>

            <!-- Course Thumbnail -->
            <div class="lg:col-span-1">
                <div class="aspect-video bg-white bg-opacity-20 rounded-xl overflow-hidden">
                    @if($course->thumbnail)
                        <img src="{{ asset('storage/' . $course->thumbnail) }}" 
                             alt="{{ $course->title }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-6xl text-white opacity-80"></i>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Course Content -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Course Description -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Tentang Kursus Ini</h2>
                    <div class="prose max-w-none">
                        {!! nl2br(e($course->description)) !!}
                    </div>
                </div>

                <!-- Course Topics -->
                @if($course->topics->count() > 0)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Materi Kursus</h2>
                        <div class="space-y-4">
                            @foreach($course->topics as $index => $topic)
                                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-4 font-semibold">
                                                {{ $index + 1 }}
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-gray-900">{{ $topic->title }}</h3>
                                                <p class="text-sm text-gray-600">{{ $topic->description }}</p>
                                            </div>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $topic->duration ? $topic->duration . ' min' : 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Course Contents -->
                @if($course->contents->count() > 0)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Konten Kursus</h2>
                        <div class="space-y-4">
                            @foreach($course->contents as $index => $content)
                                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-green-100 text-green-600 rounded-full flex items-center justify-center mr-4">
                                                <i class="fas fa-play text-sm"></i>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-gray-900">{{ $content->title }}</h3>
                                                <p class="text-sm text-gray-600">{{ $content->description }}</p>
                                            </div>
                                        </div>
                                        {{-- <div class="text-sm text-gray-500">
                                            {{ $content->duration ? $content->duration . ' min' : 'N/A' }}
                                        </div> --}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Course Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6 sticky top-24">
                    <!-- Price -->
                    <div class="text-center mb-6">
                        <div class="text-4xl font-bold text-blue-600 mb-2">
                            Rp {{ number_format($course->price, 0, ',', '.') }}
                        </div>
                        <div class="text-gray-600">Sekali bayar, akses selamanya</div>
                    </div>

                    <!-- Action Button -->
                    @auth
                        @if(Auth::user()->role === 'student')
                            @if($isEnrolled)
                                <a href="{{ route('student.courses.learn', $course) }}" 
                                   class="w-full bg-green-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-green-700 transition-colors text-center block mb-4">
                                    <i class="fas fa-play mr-2"></i>
                                    Lanjutkan Belajar
                                </a>
                            @else
                                <a href="{{ route('student.courses.enroll', $course) }}" 
                                   class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-blue-700 transition-colors text-center block mb-4">
                                    <i class="fas fa-shopping-cart mr-2"></i>
                                    Daftar Kursus
                                </a>
                            @endif
                        @elseif(Auth::user()->role === 'instructor' && Auth::id() == $course->instructor_id)
                            <a href="{{ route('instructor.courses.show', $course) }}" 
                               class="w-full bg-green-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-green-700 transition-colors text-center block mb-4">
                                <i class="fas fa-cog mr-2"></i>
                                Kelola Kursus
                            </a>
                        @else
                            <div class="w-full bg-gray-400 text-white py-3 px-4 rounded-lg font-semibold text-center mb-4 cursor-not-allowed">
                                <i class="fas fa-lock mr-2"></i>
                                Hanya untuk Siswa
                            </div>
                        @endif
                    @else
                        <a href="{{ route('login') }}" 
                           class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-blue-700 transition-colors text-center block mb-4">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Login untuk Daftar
                        </a>
                    @endauth

                    <!-- Course Info -->
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Level:</span>
                            <span class="font-semibold">{{ $course->courseLevel->name ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Kategori:</span>
                            <span class="font-semibold">{{ $course->category->name ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Siswa:</span>
                            <span class="font-semibold">{{ $course->enrollments_count }} orang</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Topik:</span>
                            <span class="font-semibold">{{ $course->topics_count }} topik</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Konten:</span>
                            <span class="font-semibold">{{ $course->contents_count }} konten</span>
                        </div>
                    </div>
                </div>

                <!-- Instructor Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Tentang Instruktur</h3>
                    <div class="flex items-center mb-4">
                        <div class="w-16 h-16 bg-gray-300 rounded-full flex items-center justify-center mr-4">
                            @if($course->instructor->avatar)
                                <img src="{{ asset('storage/' . $course->instructor->avatar) }}" 
                                     alt="{{ $course->instructor->name }}"
                                     class="w-16 h-16 rounded-full object-cover">
                            @else
                                <i class="fas fa-user text-gray-600 text-2xl"></i>
                            @endif
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">{{ $course->instructor->name }}</h4>
                            <p class="text-sm text-gray-600">Instruktur</p>
                        </div>
                    </div>
                    @if($course->instructor->bio)
                        <p class="text-sm text-gray-600">{{ Str::limit($course->instructor->bio, 150) }}</p>
                    @endif
                    <a href="{{ route('instructor.profile.show', $course->instructor) }}" 
                       class="text-blue-600 text-sm hover:text-blue-800 mt-2 inline-block">
                        Lihat Profil Lengkap
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
