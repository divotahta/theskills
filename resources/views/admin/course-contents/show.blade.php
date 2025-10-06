<x-admin-layout>
    <x-slot name="header">
        Detail Materi Kursus
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $courseContent->title }}</h2>
                    <p class="text-gray-600">{{ $courseContent->course->title }}</p>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.course-contents.edit', [$courseContent->course, $courseContent]) }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                        Edit Materi
                    </a>
                    <a href="{{ route('admin.course-contents.index') }}" 
                       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                        Kembali
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Konten Utama -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Informasi Dasar -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Materi</h3>
                        
                        @if($courseContent->description)
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Deskripsi</h4>
                                <p class="text-gray-600">{{ $courseContent->description }}</p>
                            </div>
                        @endif

                        @if($courseContent->material_content)
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Konten Materi</h4>
                                <div class="prose max-w-none">
                                    {!! nl2br(e($courseContent->material_content)) !!}
                                </div>
                            </div>
                        @endif

                        @if($courseContent->announcement)
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Pengumuman</h4>
                                <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4">
                                    <p class="text-yellow-800">{{ $courseContent->announcement }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Video YouTube -->
                    @if($courseContent->youtube_embed_url)
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Video Pembelajaran</h3>
                            <div class="aspect-w-16 aspect-h-9">
                                <iframe src="{{ $courseContent->youtube_embed_url }}" 
                                        frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                        allowfullscreen
                                        class="w-full h-64 rounded-lg">
                                </iframe>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Status dan Info -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi</h3>
                        
                        <div class="space-y-3">
                            <div>
                                <span class="text-sm font-medium text-gray-700">Status:</span>
                                <span class="ml-2 inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $courseContent->is_published ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $courseContent->is_published ? 'Dipublikasikan' : 'Disembunyikan' }}
                                </span>
                            </div>
                            
                            <div>
                                <span class="text-sm font-medium text-gray-700">Urutan:</span>
                                <span class="ml-2 text-gray-600">{{ $courseContent->order }}</span>
                            </div>
                            
                            <div>
                                <span class="text-sm font-medium text-gray-700">Kursus:</span>
                                <span class="ml-2 text-gray-600">{{ $courseContent->course->title }}</span>
                            </div>
                            
                            @if($courseContent->topic)
                                <div>
                                    <span class="text-sm font-medium text-gray-700">Topik:</span>
                                    <span class="ml-2 text-gray-600">{{ $courseContent->topic->title }}</span>
                                </div>
                            @endif
                            
                            <div>
                                <span class="text-sm font-medium text-gray-700">Dibuat:</span>
                                <span class="ml-2 text-gray-600">{{ $courseContent->created_at->format('d M Y H:i') }}</span>
                            </div>
                            
                            <div>
                                <span class="text-sm font-medium text-gray-700">Diperbarui:</span>
                                <span class="ml-2 text-gray-600">{{ $courseContent->updated_at->format('d M Y H:i') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- File Download -->
                    @if($courseContent->hasFile())
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">File Materi</h3>
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $courseContent->file_name }}</p>
                                    <a href="{{ $courseContent->file_url }}" 
                                       class="text-sm text-blue-600 hover:text-blue-500" 
                                       download>
                                        Download File
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Aksi -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi</h3>
                        <div class="space-y-2">
                            <form method="POST" action="{{ route('admin.course-contents.toggle-status', $courseContent) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="w-full text-left px-3 py-2 text-sm text-yellow-600 hover:bg-yellow-50 rounded-md">
                                    {{ $courseContent->is_published ? 'Sembunyikan Materi' : 'Publikasikan Materi' }}
                                </button>
                            </form>
                            
                            <a href="{{ route('admin.course-contents.edit', [$courseContent->course, $courseContent]) }}" 
                               class="block w-full text-left px-3 py-2 text-sm text-blue-600 hover:bg-blue-50 rounded-md">
                                Edit Materi
                            </a>
                            
                            <form method="POST" action="{{ route('admin.course-contents.destroy', $courseContent) }}" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded-md">
                                    Hapus Materi
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
