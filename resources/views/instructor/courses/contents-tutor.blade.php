@extends('layouts.instructor-tutor')

@section('content')
<div>
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
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
                    <span class="text-gray-900">Contents</span>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">Course Contents</h1>
                <p class="text-gray-600 mt-2">Manage content for "{{ $course->title }}"</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('instructor.courses.contents.create', $course) }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Add Content
                </a>
            </div>
        </div>
    </div>

    <!-- Course Info Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
        <div class="flex items-start space-x-4">
            @if($course->thumbnail)
                <img src="{{ Storage::url($course->thumbnail) }}" 
                     class="w-16 h-16 rounded-lg object-cover" 
                     alt="{{ $course->title }}">
            @else
                <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                </div>
            @endif
            
            <div class="flex-1">
                <h2 class="text-xl font-semibold text-gray-900">{{ $course->title }}</h2>
                <p class="text-gray-600 mt-1">{{ $course->description }}</p>
                <div class="flex items-center space-x-4 mt-3 text-sm text-gray-500">
                    <span>{{ $contents->total() }} contents</span>
                    <span>{{ $course->instructor->name ?? 'Unknown Instructor' }}</span>
                    <span>{{ $course->courseLevel->name ?? 'No Level' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    @if($topics->count() > 0)
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <form method="GET" action="{{ route('instructor.courses.contents.index', $course) }}" class="flex flex-wrap gap-4">
            <!-- Topic Filter -->
            <div class="min-w-48">
                <label for="topic" class="block text-sm font-medium text-gray-700 mb-2">Filter by Topic</label>
                <select id="topic" 
                        name="topic"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Topics</option>
                    @foreach($topics as $topic)
                        <option value="{{ $topic->id }}" {{ request('topic') == $topic->id ? 'selected' : '' }}>
                            {{ $topic->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Buttons -->
            <div class="flex items-end gap-2">
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    Filter
                </button>
                <a href="{{ route('instructor.courses.contents.index', $course) }}" 
                   class="px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                    Clear
                </a>
            </div>
        </form>
    </div>
    @endif

    <!-- Contents List -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        @if($contents->count() > 0)
            <div class="divide-y divide-gray-200">
                @foreach($contents as $content)
                <div class="p-6 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-2">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $content->title }}</h3>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $content->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $content->is_published ? 'Published' : 'Draft' }}
                                </span>
                                @if($content->topic)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $content->topic->title }}
                                </span>
                                @endif
                            </div>
                            
                            @if($content->description)
                            <p class="text-gray-600 mb-3">{{ $content->description }}</p>
                            @endif
                            
                            <div class="flex items-center space-x-6 text-sm text-gray-500">
                                <span>Order: {{ $content->order }}</span>
                                @if($content->youtube_embed_url)
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                    </svg>
                                    YouTube Video
                                </span>
                                @endif
                                @if($content->file_path)
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $content->file_name }}
                                </span>
                                @endif
                                <span>Created {{ $content->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        
                        <!-- Actions -->
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('instructor.courses.contents.show', [$course, $content]) }}" 
                               class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                View
                            </a>
                            <a href="{{ route('instructor.courses.contents.edit', [$course, $content]) }}" 
                               class="text-gray-600 hover:text-gray-700 text-sm font-medium">
                                Edit
                            </a>
                            
                            <!-- Actions Menu -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" 
                                        class="p-1.5 text-gray-400 hover:text-gray-600 rounded-full hover:bg-gray-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                    </svg>
                                </button>
                                
                                <div x-show="open" @click.away="open = false" x-transition
                                     class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200">
                                    <form method="POST" action="{{ route('instructor.courses.contents.toggle-status', [$course, $content]) }}" class="block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            {{ $content->is_published ? 'Unpublish' : 'Publish' }}
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('instructor.courses.contents.destroy', [$course, $content]) }}" 
                                          class="block" 
                                          onsubmit="return confirm('Are you sure you want to delete this content?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-red-50">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No content found</h3>
                <p class="text-gray-500 mb-6">Get started by adding your first course content.</p>
                <a href="{{ route('instructor.courses.contents.create', $course) }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Add Content
                </a>
            </div>
        @endif
    </div>

    <!-- Pagination -->
    @if($contents->hasPages())
    <div class="mt-8">
        {{ $contents->links() }}
    </div>
    @endif
</div>
@endsection
