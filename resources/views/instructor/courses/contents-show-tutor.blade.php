@extends('layouts.instructor-tutor')

@section('content')
<div>
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center space-x-2 text-sm text-gray-500 mb-2">
                    <a href="{{ route('instructor.courses.index') }}" class="hover:text-blue-600">Courses</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <a href="{{ route('instructor.courses.show', $course) }}" class="hover:text-blue-600">{{ $course->title }}</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <a href="{{ route('instructor.courses.contents.index', $course) }}" class="hover:text-blue-600">Contents</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span class="text-gray-900">{{ $courseContent->title }}</span>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $courseContent->title }}</h1>
                <p class="text-gray-600 mt-2">Course content details</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('instructor.courses.contents.edit', [$course, $courseContent]) }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Content
                </a>
                <a href="{{ route('instructor.courses.contents.index', $course) }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Contents
                </a>
            </div>
        </div>
    </div>

    <!-- Content Overview -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Content Info -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">{{ $courseContent->title }}</h2>
                        @if($courseContent->topic)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mt-2">
                            {{ $courseContent->topic->title }}
                        </span>
                        @endif
                    </div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $courseContent->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $courseContent->is_published ? 'Published' : 'Draft' }}
                    </span>
                </div>
                
                @if($courseContent->description)
                <p class="text-gray-600 mb-4">{{ $courseContent->description }}</p>
                @endif
                
                <div class="flex items-center space-x-6 text-sm text-gray-500">
                    <span>Order: {{ $courseContent->order }}</span>
                    <span>Created {{ $courseContent->created_at->format('M d, Y') }}</span>
                    <span>Updated {{ $courseContent->updated_at->format('M d, Y') }}</span>
                </div>
            </div>

            <!-- Material Content -->
            @if($courseContent->material_content)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Material Content</h3>
                <div class="prose max-w-none">
                    {!! nl2br(e($courseContent->material_content)) !!}
                </div>
            </div>
            @endif

            <!-- YouTube Video -->
            @if($courseContent->hasVideo())
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">YouTube Video</h3>
                <div class="aspect-w-16 aspect-h-9">
                    <iframe src="{{ $courseContent->getYoutubeEmbedUrl() }}" 
                            class="w-full h-64 rounded-lg" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                    </iframe>
                </div>
                <p class="mt-2 text-sm text-gray-500">
                    <a href="{{ $courseContent->youtube_embed_url }}" target="_blank" class="text-blue-600 hover:text-blue-700">
                        Open in YouTube →
                    </a>
                </p>
            </div>
            @endif

            <!-- File Attachment -->
            @if($courseContent->file_path)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">File Attachment</h3>
                <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">{{ $courseContent->file_name }}</p>
                        <p class="text-sm text-gray-500">File attachment</p>
                    </div>
                    <a href="{{ Storage::url($courseContent->file_path) }}" 
                       target="_blank"
                       class="inline-flex items-center px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Download
                    </a>
                </div>
            </div>
            @endif

            <!-- Announcement -->
            @if($courseContent->announcement)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Announcement</h3>
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex">
                        <svg class="w-5 h-5 text-yellow-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                        <div class="text-sm text-yellow-800">
                            {!! nl2br(e($courseContent->announcement)) !!}
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Content Stats -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Content Information</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Status</span>
                        <span class="text-sm font-medium text-gray-900">{{ $courseContent->is_published ? 'Published' : 'Draft' }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Display Order</span>
                        <span class="text-sm font-medium text-gray-900">{{ $courseContent->order }}</span>
                    </div>
                    @if($courseContent->topic)
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Topic</span>
                        <span class="text-sm font-medium text-gray-900">{{ $courseContent->topic->title }}</span>
                    </div>
                    @endif
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Created</span>
                        <span class="text-sm font-medium text-gray-900">{{ $courseContent->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Last Updated</span>
                        <span class="text-sm font-medium text-gray-900">{{ $courseContent->updated_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <form method="POST" action="{{ route('instructor.courses.contents.toggle-status', [$course, $courseContent]) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="w-full flex items-center justify-center px-4 py-2 {{ $courseContent->is_published ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} text-white text-sm font-medium rounded-lg transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($courseContent->is_published)
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"/>
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                @endif
                            </svg>
                            {{ $courseContent->is_published ? 'Unpublish Content' : 'Publish Content' }}
                        </button>
                    </form>
                    
                    <a href="{{ route('instructor.courses.contents.edit', [$course, $courseContent]) }}" 
                       class="w-full flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Content
                    </a>

                    <form method="POST" action="{{ route('instructor.courses.contents.destroy', [$course, $courseContent]) }}" 
                          onsubmit="return confirm('Are you sure you want to delete this content? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete Content
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
