<x-admin-layout>
    <x-slot name="header">
        Tambah Materi Kursus
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6">
                <form method="POST" action="{{ route('admin.course-contents.store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if(isset($course))
                            <!-- Kursus (dari course) -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Kursus
                                </label>
                                <div class="p-3 bg-gray-50 rounded-md">
                                    <p class="text-gray-900 font-medium">{{ $course->title }}</p>
                                    <p class="text-sm text-gray-600">Materi akan ditambahkan ke kursus ini</p>
                                </div>
                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                <input type="hidden" name="from_course" value="1">
                            </div>
                        @else
                            <!-- Kursus (standalone) -->
                            <div class="md:col-span-2">
                                <label for="course_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Kursus <span class="text-red-500">*</span>
                                </label>
                                <select name="course_id" id="course_id" required
                                        class="w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('course_id') border-red-500 @enderror">
                                    <option value="">Pilih Kursus</option>
                                    @foreach($courses as $courseItem)
                                        <option value="{{ $courseItem->id }}" {{ old('course_id', $selectedCourseId) == $courseItem->id ? 'selected' : '' }}>
                                            {{ $courseItem->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('course_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif

                        <!-- Topik -->
                        <div class="md:col-span-2">
                            <label for="topic_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Topik (Opsional)
                            </label>
                            <select name="topic_id" id="topic_id"
                                    class="w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('topic_id') border-red-500 @enderror">
                                <option value="">Pilih Topik</option>
                                @foreach($topics as $topic)
                                    <option value="{{ $topic->id }}" {{ old('topic_id', $selectedTopicId ?? '') == $topic->id ? 'selected' : '' }}>
                                        {{ $topic->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('topic_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Judul -->
                        <div class="md:col-span-2">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                Judul Materi <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                   class="w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                                   placeholder="Masukkan judul materi">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Deskripsi
                            </label>
                            <textarea name="description" id="description" rows="3"
                                      class="w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror"
                                      placeholder="Masukkan deskripsi materi">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Konten Materi -->
                        <div class="md:col-span-2">
                            <label for="material_content" class="block text-sm font-medium text-gray-700 mb-2">
                                Konten Materi
                            </label>
                            <textarea name="material_content" id="material_content" rows="8"
                                      class="w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('material_content') border-red-500 @enderror"
                                      placeholder="Masukkan konten materi pembelajaran">{{ old('material_content') }}</textarea>
                            @error('material_content')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- YouTube Embed URL -->
                        <div class="md:col-span-2">
                            <label for="youtube_embed_url" class="block text-sm font-medium text-gray-700 mb-2">
                                Link YouTube Embed
                            </label>
                            <input type="url" name="youtube_embed_url" id="youtube_embed_url" value="{{ old('youtube_embed_url') }}"
                                   class="w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('youtube_embed_url') border-red-500 @enderror"
                                   placeholder="https://www.youtube.com/embed/VIDEO_ID">
                            <p class="mt-1 text-sm text-gray-500">Gunakan link embed YouTube (bukan link biasa)</p>
                            @error('youtube_embed_url')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- File Upload -->
                        <div class="md:col-span-2">
                            <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                                File Materi
                            </label>
                            <input type="file" name="file" id="file"
                                   class="w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('file') border-red-500 @enderror"
                                   accept=".pdf,.doc,.docx,.txt,.zip,.rar">
                            <p class="mt-1 text-sm text-gray-500">Format yang didukung: PDF, DOC, DOCX, TXT, ZIP, RAR (Max: 10MB)</p>
                            @error('file')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Pengumuman -->
                        <div class="md:col-span-2">
                            <label for="announcement" class="block text-sm font-medium text-gray-700 mb-2">
                                Pengumuman
                            </label>
                            <textarea name="announcement" id="announcement" rows="3"
                                      class="w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('announcement') border-red-500 @enderror"
                                      placeholder="Masukkan pengumuman untuk materi ini">{{ old('announcement') }}</textarea>
                            @error('announcement')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Urutan -->
                        <div>
                            <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                                Urutan
                            </label>
                            <input type="number" name="order" id="order" value="{{ old('order') }}" min="1"
                                   class="w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('order') border-red-500 @enderror"
                                   placeholder="Urutan materi">
                            @error('order')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status Publikasi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Status Publikasi
                            </label>
                            <div class="flex items-center">
                                <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="is_published" class="ml-2 text-sm text-gray-700">
                                    Publikasikan materi ini
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-8 flex justify-end space-x-4">
                        @if(isset($course))
                            <a href="{{ route('admin.courses.show', $course) }}" 
                               class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                                Batal
                            </a>
                        @else
                            <a href="{{ route('admin.course-contents.index') }}" 
                               class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                                Batal
                            </a>
                        @endif
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Simpan Materi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
