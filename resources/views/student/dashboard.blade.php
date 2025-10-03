<x-student-layout>
    @section('header')
        Dashboard
    @endsection

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Kursus yang Diikuti -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-500 bg-opacity-75">
                            <svg class="h-8 w-8 text-white" viewBox="0 0 28 28" fill="none">
                                <path d="M6.99999 11.2H21L22.4 23.8H5.59999L6.99999 11.2Z" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                <path d="M9.79999 8.4C9.79999 6.08041 11.6804 4.2 14 4.2C16.3196 4.2 18.2 6.08041 18.2 8.4V12.6C18.2 14.9197 16.3196 16.8 14 16.8C11.6804 16.8 9.79999 14.9197 9.79999 12.6V8.4Z" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                        <div class="ml-5">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $enrolledCourses->count() }}</h3>
                            <p class="text-gray-500">Kursus Aktif</p>
                        </div>
                    </div>
                </div>

                <!-- Kursus Selesai -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-500 bg-opacity-75">
                            <svg class="h-8 w-8 text-white" viewBox="0 0 28 28" fill="none">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="ml-5">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $completedCourses }}</h3>
                            <p class="text-gray-500">Kursus Selesai</p>
                        </div>
                    </div>
                </div>

                <!-- Sertifikat -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-500 bg-opacity-75">
                            <svg class="h-8 w-8 text-white" viewBox="0 0 28 28" fill="none">
                                <path d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-4 8h8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="ml-5">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $totalCertificates }}</h3>
                            <p class="text-gray-500">Sertifikat</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kursus yang Sedang Diikuti -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Kursus yang Sedang Diikuti</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($enrolledCourses as $enrollment)
                            <div class="border rounded-lg overflow-hidden">
                                @if($enrollment->course->thumbnail)
                                    <img src="{{ Storage::url($enrollment->course->thumbnail) }}" 
                                         alt="{{ $enrollment->course->title }}" 
                                         class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                
                                <div class="p-4">
                                    <h3 class="font-semibold text-gray-900 mb-2">
                                        {{ $enrollment->course->title }}
                                    </h3>
                                    <p class="text-sm text-gray-500 mb-4">
                                        {{ Str::limit($enrollment->course->description, 100) }}
                                    </p>
                                    
                                    <!-- Progress Bar -->
                                    <div class="mb-4">
                                        <div class="flex justify-between text-sm text-gray-600 mb-1">
                                            <span>Progress</span>
                                            <span>60%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-blue-600 h-2 rounded-full" style="width: 60%"></div>
                                        </div>
                                    </div>
                                    
                                    <a href="#" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-500">
                                        Lanjutkan Belajar
                                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-3 text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada kursus yang diikuti</h3>
                                <p class="mt-1 text-sm text-gray-500">Mulai belajar dengan mengikuti kursus.</p>
                                <div class="mt-6">
                                    <a href="{{ route('student.courses.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                        Jelajahi Kursus
                                    </a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-student-layout> 