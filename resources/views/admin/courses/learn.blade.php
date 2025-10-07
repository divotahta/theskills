<x-admin-layout>
    <x-slot name="header">
        {{ $course->title }} - Pembelajaran
    </x-slot>

    <div class="min-h-screen bg-gray-50">
        <div class="flex h-screen">
            <!-- Sidebar Course Navigation -->
            <div class="w-80 bg-white border-r border-gray-200 flex flex-col">
                <!-- Course Header -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                            @if($course->thumbnail)
                                <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" class="w-full h-full object-cover rounded-lg">
                            @else
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h2 class="text-lg font-semibold text-gray-900 truncate">{{ $course->title }}</h2>
                            <p class="text-sm text-gray-500">{{ $course->instructor->name }}</p>
                        </div>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-gray-700">Progress</span>
                        <span class="text-sm text-gray-500">0%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-600 h-2 rounded-full" style="width: 0%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">0 dari {{ $course->contents->count() }} materi selesai</p>
                </div>

                <!-- Course Contents Navigation -->
                <div class="flex-1 overflow-y-auto">
                    <div class="p-4">
                        <h3 class="text-sm font-semibold text-gray-900 mb-4">Daftar Materi</h3>
                        
                        @if($course->contents->count() > 0)
                            <div class="space-y-2">
                                @foreach($course->contents->sortBy('order') as $index => $content)
                                    <div class="group">
                                        <div class="flex items-center p-3 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors {{ $index === 0 ? 'bg-blue-50 border border-blue-200' : '' }}"
                                             onclick="loadContent({{ $content->id }})">
                                            <div class="flex-shrink-0">
                                                @if($content->hasVideo())
                                                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                                        <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M8 5v14l11-7z"/>
                                                        </svg>
                                                    </div>
                                                @elseif($content->hasFile())
                                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                        </svg>
                                                    </div>
                                                @else
                                                    <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-3 flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate">{{ $content->title }}</p>
                                                <p class="text-xs text-gray-500">{{ $content->order }}. {{ $content->topic ? $content->topic->title : 'Materi' }}</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                @if($index === 0)
                                                    <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                                                @else
                                                    <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-sm text-gray-500">Belum ada materi</p>
                                <a href="{{ route('admin.courses.contents.create', $course) }}" 
                                   class="mt-2 inline-flex items-center text-blue-600 hover:text-blue-500 text-sm">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Tambah Materi
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Course Actions -->
                <div class="p-4 border-t border-gray-200">
                    <div class="space-y-2">
                        <a href="{{ route('admin.courses.show', $course) }}" 
                           class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Kelola Kursus
                        </a>
                        <a href="{{ route('admin.courses.contents.create', $course) }}" 
                           class="w-full flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah Materi
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col">
                <!-- Content Header -->
                <div class="bg-white border-b border-gray-200 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-xl font-semibold text-gray-900" id="content-title">
                                {{ $course->contents->first()?->title ?? 'Pilih Materi' }}
                            </h1>
                            <p class="text-sm text-gray-500" id="content-description">
                                {{ $course->contents->first()?->description ?? 'Belum ada materi yang dipilih' }}
                            </p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <button class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                </svg>
                            </button>
                            <button class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Video Player Area -->
                <div class="flex-1 bg-black">
                    <div class="h-full flex items-center justify-center" id="video-container">
                        @if($course->contents->first()?->hasVideo())
                            <iframe id="video-player" 
                                    src="{{ $course->contents->first()->getYoutubeEmbedUrl() }}"
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen
                                    class="w-full h-full">
                            </iframe>
                        @else
                            <div class="text-center text-white">
                                <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h1m4 0h1m-6-8h8a2 2 0 012 2v8a2 2 0 01-2 2H8a2 2 0 01-2-2V6a2 2 0 012-2z"></path>
                                </svg>
                                <p class="text-lg font-medium">Pilih materi untuk memulai pembelajaran</p>
                                <p class="text-sm opacity-75">Gunakan sidebar untuk navigasi antar materi</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Content Details -->
                <div class="bg-white border-t border-gray-200 p-6">
                    <div class="max-w-4xl mx-auto">
                        <!-- Material Content -->
                        <div id="material-content" class="prose max-w-none">
                            @if($course->contents->first()?->material_content)
                                {!! nl2br(e($course->contents->first()->material_content)) !!}
                            @else
                                <p class="text-gray-500">Belum ada konten materi yang tersedia.</p>
                            @endif
                        </div>

                        <!-- Announcement -->
                        @if($course->contents->first()?->hasAnnouncement())
                            <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-yellow-800">Pengumuman</h3>
                                        <div class="mt-2 text-sm text-yellow-700">
                                            <p id="announcement-content">{{ $course->contents->first()->announcement }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- File Download -->
                        @if($course->contents->first()?->hasFile())
                            <div class="mt-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <p class="text-sm font-medium text-gray-900" id="file-name">{{ $course->contents->first()->file_name }}</p>
                                        <a href="{{ $course->contents->first()->file_url }}" 
                                           class="text-sm text-blue-600 hover:text-blue-500" 
                                           download id="file-download">
                                            Download File
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Course content data
        const courseContents = {!! json_encode($course->contents->map(function($content) {
            return [
                'id' => $content->id,
                'title' => $content->title,
                'description' => $content->description,
                'material_content' => $content->material_content,
                'youtube_embed_url' => $content->youtube_embed_url,
                'announcement' => $content->announcement,
                'file_name' => $content->file_name,
                'file_url' => $content->file_url,
                'has_video' => $content->hasVideo(),
                'has_file' => $content->hasFile(),
                'has_announcement' => $content->hasAnnouncement(),
            ];
        })) !!};

        function loadContent(contentId) {
            const content = courseContents.find(c => c.id === contentId);
            if (!content) return;

            // Update title and description
            document.getElementById('content-title').textContent = content.title;
            document.getElementById('content-description').textContent = content.description || '';

            // Update video player
            const videoContainer = document.getElementById('video-container');
            if (content.has_video) {
                videoContainer.innerHTML = `
                    <iframe id="video-player" 
                            src="${content.youtube_embed_url}" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen
                            class="w-full h-full">
                    </iframe>
                `;
            } else {
                videoContainer.innerHTML = `
                    <div class="text-center text-white">
                        <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="text-lg font-medium">Materi Teori</p>
                        <p class="text-sm opacity-75">Baca konten materi di bawah</p>
                    </div>
                `;
            }

            // Update material content
            const materialContent = document.getElementById('material-content');
            if (content.material_content) {
                materialContent.innerHTML = content.material_content.replace(/\n/g, '<br>');
            } else {
                materialContent.innerHTML = '<p class="text-gray-500">Belum ada konten materi yang tersedia.</p>';
            }

            // Update announcement
            const announcementContent = document.getElementById('announcement-content');
            if (announcementContent) {
                if (content.has_announcement) {
                    announcementContent.textContent = content.announcement;
                    announcementContent.closest('.mt-6').style.display = 'block';
                } else {
                    announcementContent.closest('.mt-6').style.display = 'none';
                }
            }

            // Update file download
            const fileName = document.getElementById('file-name');
            const fileDownload = document.getElementById('file-download');
            if (fileName && fileDownload) {
                if (content.has_file) {
                    fileName.textContent = content.file_name;
                    fileDownload.href = content.file_url;
                    fileName.closest('.mt-6').style.display = 'block';
                } else {
                    fileName.closest('.mt-6').style.display = 'none';
                }
            }

            // Update active state in sidebar
            document.querySelectorAll('.group').forEach(group => {
                group.querySelector('.flex').classList.remove('bg-blue-50', 'border', 'border-blue-200');
                group.querySelector('.w-2').classList.remove('bg-blue-600');
                group.querySelector('.w-2').classList.add('bg-gray-300');
            });

            // Set active state for current content
            const activeGroup = document.querySelector(`[onclick="loadContent(${contentId})"]`).closest('.group');
            activeGroup.querySelector('.flex').classList.add('bg-blue-50', 'border', 'border-blue-200');
            activeGroup.querySelector('.w-2').classList.remove('bg-gray-300');
            activeGroup.querySelector('.w-2').classList.add('bg-blue-600');
        }
    </script>
</x-admin-layout>
