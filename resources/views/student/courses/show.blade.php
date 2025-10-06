<x-student-layout>
    <x-slot name="header">
        {{ $course->title }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Course Header -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-8">
                <div class="md:flex">
                    <!-- Course Thumbnail -->
                    <div class="md:w-1/3">
                        <div class="h-64 md:h-full bg-gradient-to-br from-blue-500 to-purple-600">
                            @if($course->thumbnail)
                                <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="flex items-center justify-center h-full">
                                    <svg class="w-24 h-24 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Course Info -->
                    <div class="md:w-2/3 p-8">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <div class="flex items-center mb-2">
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold bg-blue-100 text-blue-800 rounded-full">
                                        {{ $course->category->name }}
                                    </span>
                                </div>
                                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $course->title }}</h1>
                                <p class="text-gray-600 text-lg">{{ $course->description }}</p>
                            </div>
                            <div class="text-right">
                                @if($course->price > 0)
                                    <div class="text-3xl font-bold text-gray-900">Rp {{ number_format($course->price, 0, ',', '.') }}</div>
                                @else
                                    <div class="text-3xl font-bold text-green-600">Gratis</div>
                                @endif
                            </div>
                        </div>

                        <!-- Instructor -->
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center">
                                <span class="text-lg font-medium text-gray-600">
                                    {{ substr($course->instructor->name, 0, 1) }}
                                </span>
                            </div>
                            <div class="ml-4">
                                <p class="text-lg font-medium text-gray-900">{{ $course->instructor->name }}</p>
                                <p class="text-gray-500">Instructor</p>
                            </div>
                        </div>

                        <!-- Stats -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900">{{ $course->enrollments_count }}</div>
                                <div class="text-sm text-gray-500">Siswa</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900">{{ $course->contents_count ?? 0 }}</div>
                                <div class="text-sm text-gray-500">Materi</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900">{{ ucfirst($course->video_type) }}</div>
                                <div class="text-sm text-gray-500">Tipe Video</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900">{{ $course->is_public ? 'Publik' : 'Privat' }}</div>
                                <div class="text-sm text-gray-500">Status</div>
                            </div>
                        </div>

                        <!-- Rating -->
                        @if($course->reviews->count() > 0)
                            <div class="flex items-center mb-6">
                                <div class="flex items-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= $course->reviews->avg('rating') ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="ml-2 text-sm text-gray-600">
                                    {{ number_format($course->reviews->avg('rating'), 1) }} ({{ $course->reviews->count() }} ulasan)
                                </span>
                            </div>
                        @endif

                        <!-- Progress (if enrolled) -->
                        @if($isEnrolled)
                            <div class="mb-6">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-gray-700">Progress Anda</span>
                                    <span class="text-sm text-gray-500">{{ $progress }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-blue-600 h-3 rounded-full transition-all duration-300" style="width: {{ $progress }}%"></div>
                                </div>
                            </div>
                        @endif

                        <!-- Actions -->
                        <div class="flex space-x-4">
                            @if($isEnrolled)
                                <a href="{{ route('student.courses.learn', $course) }}" 
                                   class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg text-center font-medium transition-colors">
                                    {{ $progress > 0 ? 'Lanjutkan Belajar' : 'Mulai Belajar' }}
                                </a>
                            @else
                                <form method="POST" action="{{ route('student.courses.enroll', $course) }}" class="flex-1">
                                    @csrf
                                    <button type="submit" 
                                            class="w-full bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                                        {{ $course->price > 0 ? 'Daftar Sekarang' : 'Mulai Gratis' }}
                                    </button>
                                </form>
                            @endif
                            <a href="{{ route('student.courses.index') }}" 
                               class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition-colors">
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Course Content -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Konten Kursus</h2>
                        
                        @if($course->contents->count() > 0)
                            <div class="space-y-4">
                                @foreach($course->contents->sortBy('order') as $index => $content)
                                    <div class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                        <div class="flex-shrink-0">
                                            @if($content->hasVideo())
                                                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M8 5v14l11-7z"/>
                                                    </svg>
                                                </div>
                                            @elseif($content->hasFile())
                                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                </div>
                                            @else
                                                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4 flex-1">
                                            <h3 class="text-lg font-medium text-gray-900">{{ $content->title }}</h3>
                                            <p class="text-sm text-gray-500">{{ $content->order }}. {{ $content->topic ? $content->topic->title : 'Materi' }}</p>
                                            @if($content->description)
                                                <p class="text-sm text-gray-600 mt-1">{{ Str::limit($content->description, 100) }}</p>
                                            @endif
                                        </div>
                                        <div class="flex-shrink-0">
                                            <span class="text-sm text-gray-500">
                                                @if($content->hasVideo())
                                                    Video
                                                @elseif($content->hasFile())
                                                    File
                                                @else
                                                    Teori
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-gray-500">Belum ada konten materi</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Course Info -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Kursus</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Kategori</span>
                                <span class="font-medium">{{ $course->category->name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Instructor</span>
                                <span class="font-medium">{{ $course->instructor->name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tipe Video</span>
                                <span class="font-medium">{{ ucfirst($course->video_type) }}</span>
                            </div>
                            @if($course->max_students)
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Max Siswa</span>
                                    <span class="font-medium">{{ $course->max_students }}</span>
                                </div>
                            @endif
                            <div class="flex justify-between">
                                <span class="text-gray-600">Status</span>
                                <span class="font-medium {{ $course->is_public ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $course->is_public ? 'Publik' : 'Privat' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Instructor Info -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Tentang Instructor</h3>
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center">
                                <span class="text-lg font-medium text-gray-600">
                                    {{ substr($course->instructor->name, 0, 1) }}
                                </span>
                            </div>
                            <div class="ml-3">
                                <p class="font-medium text-gray-900">{{ $course->instructor->name }}</p>
                                <p class="text-sm text-gray-500">Instructor</p>
                            </div>
                        </div>
                        @if($course->instructor->bio)
                            <p class="text-sm text-gray-600">{{ $course->instructor->bio }}</p>
                        @endif
                    </div>

                    <!-- Related Courses -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Kursus Lainnya</h3>
                        <div class="space-y-3">
                            @foreach($course->category->courses->where('id', '!=', $course->id)->take(3) as $relatedCourse)
                                <a href="{{ route('student.courses.show', $relatedCourse) }}" 
                                   class="block p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                    <h4 class="font-medium text-gray-900 text-sm">{{ $relatedCourse->title }}</h4>
                                    <p class="text-xs text-gray-500 mt-1">{{ $relatedCourse->instructor->name }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-student-layout>
