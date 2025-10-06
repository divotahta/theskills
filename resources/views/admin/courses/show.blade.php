<x-admin-layout>
    <x-slot name="header">
        Detail Kursus
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6 flex justify-between items-center">
                    <div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $course->title }}</h2>
                    <p class="text-gray-600">Oleh {{ $course->instructor->name }}</p>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.courses.learn', $course) }}" 
                       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h1m4 0h1m-6-8h8a2 2 0 012 2v8a2 2 0 01-2 2H8a2 2 0 01-2-2V6a2 2 0 012-2z"></path>
                                        </svg>
                        Learn Course
                    </a>
                    <a href="{{ route('admin.course-contents.create-from-course', $course) }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                        Tambah Materi
                        </a>
                        <a href="{{ route('admin.courses.edit', $course) }}" 
                       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                        Edit Kursus
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Konten Utama -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Informasi Kursus -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Kursus</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                <span class="text-sm font-medium text-gray-700">Kategori:</span>
                                <span class="ml-2 text-gray-600">{{ $course->category->name }}</span>
                                        </div>
                                        <div>
                                <span class="text-sm font-medium text-gray-700">Harga:</span>
                                <span class="ml-2 text-gray-600">Rp {{ number_format($course->price, 0, ',', '.') }}</span>
                                        </div>
                                        <div>
                                <span class="text-sm font-medium text-gray-700">Status:</span>
                                <span class="ml-2 inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $course->is_public ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $course->is_public ? 'Publik' : 'Privat' }}
                                </span>
                                        </div>
                                        <div>
                                <span class="text-sm font-medium text-gray-700">Siswa Terdaftar:</span>
                                <span class="ml-2 text-gray-600">{{ $course->enrollments->count() }}</span>
                        </div>
                    </div>

                        @if($course->description)
                            <div class="mt-4">
                                <span class="text-sm font-medium text-gray-700">Deskripsi:</span>
                                <p class="mt-1 text-gray-600">{{ $course->description }}</p>
                        </div>
                    @endif
                </div>

                    <!-- Daftar Materi -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Materi Kursus</h3>
                        </div>
                        
                        @if($course->contents->count() > 0)
                            <div class="divide-y divide-gray-200">
                                @foreach($course->contents as $content)
                                    <div class="p-6 hover:bg-gray-50">
                                        <div class="flex items-center justify-between">
                                            <div class="flex-1">
                                                <div class="flex items-center">
                                                    <span class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-600 text-sm font-medium rounded-full mr-3">
                                                        {{ $content->order }}
                                                    </span>
                                                    <div>
                                                        <h4 class="text-lg font-medium text-gray-900">{{ $content->title }}</h4>
                                                        @if($content->description)
                                                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($content->description, 100) }}</p>
                                                        @endif
                                                        <div class="flex items-center mt-2 space-x-4 text-sm text-gray-500">
                                                            @if($content->hasVideo())
                                                                <span class="flex items-center">
                                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h1m4 0h1m-6-8h8a2 2 0 012 2v8a2 2 0 01-2 2H8a2 2 0 01-2-2V6a2 2 0 012-2z"></path>
                                                                    </svg>
                                                                    Video
                                                                </span>
                                                            @endif
                                                            @if($content->hasFile())
                                                                <span class="flex items-center">
                                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                                    </svg>
                                                                    File
                                                                </span>
                                                            @endif
                                                            @if($content->hasAnnouncement())
                                                                <span class="flex items-center">
                                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                                                                    </svg>
                                                                    Pengumuman
                                                                </span>
                                                            @endif
                            </div>
                            </div>
                        </div>
                    </div>
                                            <div class="flex items-center space-x-2">
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $content->is_published ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $content->is_published ? 'Publik' : 'Privat' }}
                                                </span>
                                                <div class="flex space-x-1">
                                                    <a href="{{ route('admin.course-contents.show', $content) }}" 
                                                       class="text-blue-600 hover:text-blue-900 text-sm">Lihat</a>
                                                    <a href="{{ route('admin.course-contents.edit', [$course, $content]) }}" 
                                                       class="text-indigo-600 hover:text-indigo-900 text-sm">Edit</a>
                                                    <form method="POST" action="{{ route('admin.course-contents.toggle-status', $content) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                                        <button type="submit" class="text-yellow-600 hover:text-yellow-900 text-sm">
                                                            {{ $content->is_published ? 'Sembunyikan' : 'Publikasikan' }}
                                </button>
                            </form>
                                                    <form method="POST" action="{{ route('admin.course-contents.destroy', $content) }}" class="inline" 
                                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?')">
                                @csrf
                                @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Hapus</button>
                            </form>
                        </div>
                    </div>
                                        </div>
                        </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-6 text-center text-gray-500">
                                <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p>Belum ada materi untuk kursus ini</p>
                                <a href="{{ route('admin.course-contents.create-from-course', $course) }}" 
                                   class="mt-2 inline-flex items-center text-blue-600 hover:text-blue-500">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Tambah Materi Pertama
                                    </a>
                                </div>
                            @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Thumbnail -->
                    @if($course->thumbnail)
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Thumbnail</h3>
                            <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" class="w-full rounded-lg">
                                </div>
                            @endif

                    <!-- Statistik -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistik</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Total Materi:</span>
                                <span class="text-sm font-medium text-gray-900">{{ $course->contents->count() }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Materi Publik:</span>
                                <span class="text-sm font-medium text-gray-900">{{ $course->contents->where('is_published', true)->count() }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Total Topik:</span>
                                <span class="text-sm font-medium text-gray-900">{{ $course->topics->count() }}</span>
                        </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Siswa Terdaftar:</span>
                                <span class="text-sm font-medium text-gray-900">{{ $course->enrollments->count() }}</span>
                    </div>
                </div>
            </div>

                    <!-- Aksi Cepat -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
                        <div class="space-y-2">
                            <a href="{{ route('admin.course-contents.create-from-course', $course) }}" 
                               class="block w-full text-left px-3 py-2 text-sm text-blue-600 hover:bg-blue-50 rounded-md">
                                Tambah Materi Baru
                            </a>
                            <a href="{{ route('admin.courses.edit', $course) }}" 
                               class="block w-full text-left px-3 py-2 text-sm text-indigo-600 hover:bg-indigo-50 rounded-md">
                                Edit Kursus
                            </a>
                            <a href="{{ route('admin.courses.index') }}" 
                               class="block w-full text-left px-3 py-2 text-sm text-gray-600 hover:bg-gray-50 rounded-md">
                                Kembali ke Daftar Kursus
                            </a>
                            </div>
                        </div>
                    </div>
                    </div>
        </div>
    </div>
</x-admin-layout>
