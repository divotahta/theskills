@extends('layouts.admin-tutor')

@section('content')
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $topic->title }}</h1>
                <p class="text-gray-600 mt-2">Topic Details and Contents</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.topics.edit', $topic) }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Topic
                </a>
                <a href="{{ route('admin.topics.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Topics
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Topic Information -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-lg font-semibold text-gray-900">{{ $topic->title }}</h2>
                        <p class="text-sm text-gray-500">Topic Information</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <!-- Course -->
                    <div>
                        <label class="text-sm font-medium text-gray-500">Course</label>
                        <div class="mt-1">
                            <a href="{{ route('admin.courses.show', $topic->course) }}" 
                               class="text-blue-600 hover:text-blue-700 font-medium">
                                {{ $topic->course->title }}
                            </a>
                            <p class="text-sm text-gray-500">{{ $topic->course->instructor->name }}</p>
                        </div>
                    </div>

                    <!-- Order -->
                    <div>
                        <label class="text-sm font-medium text-gray-500">Order</label>
                        <div class="mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $topic->order }}
                            </span>
                        </div>
                    </div>

                    <!-- Duration -->
                    <div>
                        <label class="text-sm font-medium text-gray-500">Duration</label>
                        <div class="mt-1">
                            <p class="text-sm text-gray-900">{{ $topic->duration ?? 'Not specified' }}</p>
                        </div>
                    </div>

                    <!-- Contents Count -->
                    <div>
                        <label class="text-sm font-medium text-gray-500">Contents</label>
                        <div class="mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                {{ $topic->contents->count() }} content{{ $topic->contents->count() != 1 ? 's' : '' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                @if($topic->description)
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <label class="text-sm font-medium text-gray-500">Description</label>
                        <div class="mt-2">
                            <p class="text-sm text-gray-700">{{ $topic->description }}</p>
                        </div>
                    </div>
                @endif

                <!-- Actions -->
                <div class="mt-6 pt-6 border-t border-gray-200 space-y-2">
                    <a href="{{ route('admin.topics.edit', $topic) }}" 
                       class="w-full flex items-center justify-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Topic
                    </a>
                    
                    <form method="POST" action="{{ route('admin.topics.destroy', $topic) }}" 
                          onsubmit="return confirm('Are you sure you want to delete this topic? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full flex items-center justify-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Topic
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Contents List -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Contents</h3>
                        <a href="{{ route('admin.courses.contents.create', $topic->course) }}" 
                           class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Add Content
                        </a>
                    </div>
                </div>

                <div class="p-6">
                    @if($topic->contents->count() > 0)
                        <div class="space-y-4">
                            @foreach($topic->contents as $content)
                                <div class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                    <div class="flex-shrink-0">
                                        @if($content->hasVideo())
                                            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M8 5v14l11-7z"/>
                                                </svg>
                                            </div>
                                        @elseif($content->hasFile())
                                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                            </div>
                                        @else
                                            <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4 flex-1 min-w-0">
                                        <h4 class="text-sm font-medium text-gray-900">{{ $content->title }}</h4>
                                        @if($content->description)
                                            <p class="text-sm text-gray-500 truncate">{{ $content->description }}</p>
                                        @endif
                                        <div class="flex items-center mt-1 space-x-2">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                                Order: {{ $content->order }}
                                            </span>
                                            @if($content->is_published)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                                    Published
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    Draft
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 flex items-center space-x-2">
                                        <a href="{{ route('admin.courses.contents.show', [$topic->course, $content]) }}" 
                                           class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                            View
                                        </a>
                                        <a href="{{ route('admin.courses.contents.edit', [$topic->course, $content]) }}" 
                                           class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">
                                            Edit
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No contents yet</h3>
                            <p class="text-gray-500 mb-4">This topic doesn't have any content yet.</p>
                            <a href="{{ route('admin.courses.contents.create', $topic->course) }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Add First Content
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
