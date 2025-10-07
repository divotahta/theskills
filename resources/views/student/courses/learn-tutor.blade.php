@extends('layouts.student-tutor')

@section('content')
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-2 text-sm text-gray-500 mb-2">
            <a href="{{ route('student.courses.index') }}" class="hover:text-blue-600">My Courses</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-gray-900">{{ $course->title }}</span>
        </div>
        <h1 class="text-3xl font-bold text-gray-900">{{ $course->title }}</h1>
        <p class="text-gray-600 mt-2">Learning Interface</p>
    </div>

    <div class="min-h-screen bg-gray-50">
        <div class="flex h-screen">
            <!-- Sidebar Course Navigation -->
            <div class="w-80 bg-white border-r border-gray-200 flex flex-col">
                <!-- Course Header -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                            @if ($course->thumbnail)
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
                        <span class="text-sm text-gray-500" id="progress-percentage">{{ $progress['percentage'] }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-600 h-2 rounded-full transition-all duration-300" 
                             style="width: {{ $progress['percentage'] }}%" id="progress-bar"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1" id="progress-text">
                        {{ $progress['completed'] }} dari {{ $progress['total'] }} materi selesai
                    </p>
                </div>

                <!-- Course Topics Navigation -->
                <div class="flex-1 overflow-y-auto">
                    <div class="p-4">
                        <h3 class="text-sm font-semibold text-gray-900 mb-4">Course Topics</h3>

                        @if ($course->topics->count() > 0)
                            <div class="space-y-2">
                                @foreach ($course->topics->sortBy('order') as $topicIndex => $topic)
                                    <div class="group">
                                        <!-- Topic Header -->
                                        <div class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors"
                                             onclick="toggleTopic({{ $topic->id }})">
                                            <div class="flex items-center space-x-3">
                                                <div class="flex-shrink-0">
                                                    <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center">
                                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <h4 class="text-sm font-medium text-gray-900">{{ $topic->title }}</h4>
                                                    <p class="text-xs text-gray-500">{{ $topic->contents->count() }} contents</p>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <svg class="w-4 h-4 text-gray-400 transform transition-transform" id="topic-arrow-{{ $topic->id }}">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </div>
                                        </div>

                                        <!-- Topic Contents (Collapsible) -->
                                        <div class="ml-4 space-y-1 hidden" id="topic-contents-{{ $topic->id }}">
                                            @if ($topic->contents->count() > 0)
                                                @foreach ($topic->contents->sortBy('order') as $contentIndex => $content)
                                                    @php
                                                        $isCompleted = $content->isCompletedBy(auth()->id());
                                                        $isActive = $topicIndex === 0 && $contentIndex === 0;
                                                    @endphp
                                                    <div class="flex items-center p-2 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors {{ $isActive ? 'bg-blue-50 border border-blue-200' : '' }} {{ $isCompleted ? 'bg-green-50' : '' }}"
                                                         onclick="loadContent({{ $content->id }})">
                                                        <div class="flex-shrink-0">
                                                            @if ($content->hasVideo())
                                                                <div class="w-6 h-6 {{ $isCompleted ? 'bg-green-100' : 'bg-red-100' }} rounded-full flex items-center justify-center">
                                                                    @if ($isCompleted)
                                                                        <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                                        </svg>
                                                                    @else
                                                                        <svg class="w-3 h-3 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                                                            <path d="M8 5v14l11-7z"/>
                                                                        </svg>
                                                                    @endif
                                                                </div>
                                                            @elseif($content->hasFile())
                                                                <div class="w-6 h-6 {{ $isCompleted ? 'bg-green-100' : 'bg-green-100' }} rounded-full flex items-center justify-center">
                                                                    @if ($isCompleted)
                                                                        <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                                        </svg>
                                                                    @else
                                                                        <svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                                        </svg>
                                                                    @endif
                                                                </div>
                                                            @else
                                                                <div class="w-6 h-6 {{ $isCompleted ? 'bg-green-100' : 'bg-gray-100' }} rounded-full flex items-center justify-center">
                                                                    @if ($isCompleted)
                                                                        <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                                        </svg>
                                                                    @else
                                                                        <svg class="w-3 h-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                                        </svg>
                                                                    @endif
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="ml-3 flex-1 min-w-0">
                                                            <p class="text-xs font-medium {{ $isCompleted ? 'text-green-900' : 'text-gray-900' }} truncate">{{ $content->title }}</p>
                                                            <p class="text-xs text-gray-500">{{ $content->order }}. {{ $topic->title }}</p>
                                                        </div>
                                                        <div class="flex-shrink-0 flex items-center space-x-1">
                                                            @if ($isActive)
                                                                <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                                                            @endif
                                                            @if ($isCompleted)
                                                                <div class="w-2 h-2 bg-green-600 rounded-full" title="Completed"></div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="p-2 text-center">
                                                    <p class="text-xs text-gray-500">No contents yet</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                                <p class="text-sm text-gray-500">No topics yet</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col">
                <!-- Video Player Area -->
                <div class="flex-1 bg-black">
                    <div class="h-full flex items-center justify-center" id="video-container">
                        @if ($course->contents->first()?->hasVideo())
                            <iframe id="video-player" src="{{ $course->contents->first()->getYoutubeEmbedUrl() }}"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen class="w-full h-full">
                            </iframe>
                        @else
                            <div class="text-center text-white">
                                <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h1m4 0h1m-6-8h8a2 2 0 012 2v8a2 2 0 01-2 2H8a2 2 0 01-2-2V6a2 2 0 012-2z">
                                    </path>
                                </svg>
                                <p class="text-lg font-medium">Select a content to start learning</p>
                                <p class="text-sm opacity-75">Use the sidebar to navigate between topics and contents</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Content Information Panel -->
                <div class="bg-white border-t border-gray-200 p-6">
                    <div class="max-w-4xl mx-auto">
                        <!-- Content Header -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex-1">
                                <!-- Content Title -->
                                <h2 id="content-title" class="text-2xl font-bold text-gray-900 mb-2">
                                    {{ $course->contents->first()?->title ?? 'Select a content to view details' }}
                                </h2>

                                <!-- Content Description -->
                                <p id="content-description" class="text-gray-600">
                                    {{ $course->contents->first()?->description ?? 'Choose a content from the sidebar to see its description and materials.' }}
                                </p>
                            </div>
                            
                            <!-- Mark as Completed Button -->
                            <div class="ml-6">
                                <button id="mark-completed-btn" 
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                                        onclick="toggleContentCompletion()"
                                        style="display: none;">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span id="completion-text">Mark as Completed</span>
                                </button>
                                
                                <!-- Completion Status -->
                                <div id="completion-status" class="text-sm text-gray-500 mt-2" style="display: none;">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-green-600 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>Completed on <span id="completed-date"></span></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Material Content -->
                        <div id="material-content" class="prose max-w-none">
                            @if ($course->contents->first()?->material_content)
                                {!! nl2br(e($course->contents->first()->material_content)) !!}
                            @else
                                <p class="text-gray-500">No material content available for this content.</p>
                            @endif
                        </div>

                        <!-- Announcement -->
                        @if ($course->contents->first()?->hasAnnouncement())
                            <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-yellow-800">Announcement</h3>
                                        <div class="mt-2 text-sm text-yellow-700">
                                            <p id="announcement-content">{{ $course->contents->first()->announcement }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- File Download -->
                        @if ($course->contents->first()?->hasFile())
                            <div class="mt-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <p class="text-sm font-medium text-gray-900" id="file-name">
                                            {{ $course->contents->first()->file_name }}</p>
                                        <a href="{{ $course->contents->first()->file_url }}"
                                            class="text-sm text-blue-600 hover:text-blue-500" download id="file-download">
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
        // Course content data with progress
        const courseContents = {!! json_encode(
            $course->contents->map(function ($content) {
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
                    'is_completed' => $content->isCompletedBy(auth()->id()),
                    'completed_at' => $content->userProgress(auth()->id())?->completed_at?->format('M j, Y g:i A'),
                ];
            }),
        ) !!};

        let currentContentId = null;

        function loadContent(contentId) {
            const content = courseContents.find(c => c.id === contentId);
            if (!content) return;

            currentContentId = contentId;

            // Update title and description
            document.getElementById('content-title').textContent = content.title;
            document.getElementById('content-description').textContent = content.description || '';

            // Update completion status
            updateCompletionStatus(content);

            // Update video player
            const videoContainer = document.getElementById('video-container');
            if (content.has_video) {
                // Convert YouTube URL to embed format
                let embedUrl = content.youtube_embed_url;
                if (embedUrl.includes('youtube.com/watch')) {
                    const videoId = embedUrl.match(/[?&]v=([^&]+)/)?.[1];
                    if (videoId) {
                        embedUrl = `https://www.youtube.com/embed/${videoId}`;
                    }
                } else if (embedUrl.includes('youtu.be/')) {
                    const videoId = embedUrl.match(/youtu\.be\/([^?&]+)/)?.[1];
                    if (videoId) {
                        embedUrl = `https://www.youtube.com/embed/${videoId}`;
                    }
                }
                
                videoContainer.innerHTML = `
                    <iframe id="video-player" 
                            src="${embedUrl}" 
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
                        <p class="text-lg font-medium">No video available</p>
                        <p class="text-sm opacity-75">This content doesn't have a video</p>
                    </div>
                `;
            }

            // Update material content
            const materialContent = document.getElementById('material-content');
            if (content.material_content) {
                materialContent.innerHTML = content.material_content.replace(/\n/g, '<br>');
            } else {
                materialContent.innerHTML = '<p class="text-gray-500">No material content available for this content.</p>';
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
                    fileDownload.closest('.mt-6').style.display = 'block';
                } else {
                    fileDownload.closest('.mt-6').style.display = 'none';
                }
            }
        }

        function updateCompletionStatus(content) {
            const markCompletedBtn = document.getElementById('mark-completed-btn');
            const completionStatus = document.getElementById('completion-status');
            const completionText = document.getElementById('completion-text');
            const completedDate = document.getElementById('completed-date');

            if (content.is_completed) {
                markCompletedBtn.style.display = 'none';
                completionStatus.style.display = 'block';
                completedDate.textContent = content.completed_at || 'Unknown';
            } else {
                markCompletedBtn.style.display = 'inline-flex';
                completionStatus.style.display = 'none';
                completionText.textContent = 'Mark as Completed';
                markCompletedBtn.className = markCompletedBtn.className.replace('bg-red-600 hover:bg-red-700', 'bg-green-600 hover:bg-green-700');
            }
        }

        function toggleContentCompletion() {
            if (!currentContentId) return;

            const content = courseContents.find(c => c.id === currentContentId);
            if (!content) return;

            const isCompleted = content.is_completed;
            const newStatus = !isCompleted;

            // Show loading state
            const btn = document.getElementById('mark-completed-btn');
            const originalText = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<svg class="w-4 h-4 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>Updating...';

            // Make API call
            fetch(`{{ route('student.courses.toggle-progress', $course) }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    content_id: currentContentId,
                    completed: newStatus
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update local data
                    content.is_completed = data.completed;
                    content.completed_at = data.completed_at;

                    // Update UI
                    updateCompletionStatus(content);
                    updateProgressBar(data.course_progress);
                    updateSidebarContent(currentContentId, data.completed);

                    // Show success message
                    showNotification(newStatus ? 'Content marked as completed!' : 'Content marked as incomplete!', 'success');
                } else {
                    throw new Error('Failed to update progress');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Failed to update progress. Please try again.', 'error');
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerHTML = originalText;
            });
        }

        function updateProgressBar(progress) {
            document.getElementById('progress-percentage').textContent = progress.percentage + '%';
            document.getElementById('progress-bar').style.width = progress.percentage + '%';
            document.getElementById('progress-text').textContent = `${progress.completed} dari ${progress.total} materi selesai`;
        }

        function updateSidebarContent(contentId, isCompleted) {
            // Find the content element in sidebar and update its appearance
            const contentElements = document.querySelectorAll(`[onclick="loadContent(${contentId})"]`);
            contentElements.forEach(element => {
                if (isCompleted) {
                    element.classList.add('bg-green-50');
                    element.classList.remove('bg-blue-50');
                    
                    // Update icon to checkmark
                    const iconContainer = element.querySelector('.flex-shrink-0 > div');
                    if (iconContainer) {
                        iconContainer.className = iconContainer.className.replace(/bg-(red|gray)-100/, 'bg-green-100');
                        const icon = iconContainer.querySelector('svg');
                        if (icon) {
                            icon.innerHTML = '<path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>';
                        }
                    }
                    
                    // Update text color
                    const title = element.querySelector('.text-xs.font-medium');
                    if (title) {
                        title.classList.remove('text-gray-900');
                        title.classList.add('text-green-900');
                    }
                    
                    // Add completed indicator
                    const indicators = element.querySelector('.flex-shrink-0:last-child');
                    if (indicators) {
                        const completedDot = document.createElement('div');
                        completedDot.className = 'w-2 h-2 bg-green-600 rounded-full';
                        completedDot.title = 'Completed';
                        indicators.appendChild(completedDot);
                    }
                } else {
                    element.classList.remove('bg-green-50');
                    
                    // Revert icon
                    const iconContainer = element.querySelector('.flex-shrink-0 > div');
                    if (iconContainer) {
                        // This would need more complex logic to revert to original icon
                        // For now, just update the class
                        iconContainer.className = iconContainer.className.replace('bg-green-100', 'bg-gray-100');
                    }
                    
                    // Revert text color
                    const title = element.querySelector('.text-xs.font-medium');
                    if (title) {
                        title.classList.remove('text-green-900');
                        title.classList.add('text-gray-900');
                    }
                    
                    // Remove completed indicator
                    const completedDot = element.querySelector('.w-2.h-2.bg-green-600');
                    if (completedDot) {
                        completedDot.remove();
                    }
                }
            });
        }

        function showNotification(message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg text-white ${
                type === 'success' ? 'bg-green-600' : 
                type === 'error' ? 'bg-red-600' : 'bg-blue-600'
            }`;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            // Remove after 3 seconds
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        function toggleTopic(topicId) {
            const contentsDiv = document.getElementById(`topic-contents-${topicId}`);
            const arrow = document.getElementById(`topic-arrow-${topicId}`);
            
            if (contentsDiv.classList.contains('hidden')) {
                contentsDiv.classList.remove('hidden');
                arrow.style.transform = 'rotate(180deg)';
            } else {
                contentsDiv.classList.add('hidden');
                arrow.style.transform = 'rotate(0deg)';
            }
        }

        // Auto-expand first topic on page load
        document.addEventListener('DOMContentLoaded', function() {
            const firstTopic = document.querySelector('[onclick^="toggleTopic"]');
            if (firstTopic) {
                firstTopic.click();
            }
        });
    </script>
@endsection
