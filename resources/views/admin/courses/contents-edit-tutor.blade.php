@extends('layouts.admin-tutor')

@section('content')
<div>
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center space-x-2 text-sm text-gray-500 mb-2">
                    <a href="{{ route('admin.courses.index') }}" class="hover:text-blue-600">Courses</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <a href="{{ route('admin.courses.show', $course) }}" class="hover:text-blue-600">{{ $course->title }}</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <a href="{{ route('admin.courses.contents.index', $course) }}" class="hover:text-blue-600">Contents</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span class="text-gray-900">Edit Content</span>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">Edit Course Content</h1>
                <p class="text-gray-600 mt-2">Update content for "{{ $course->title }}"</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.courses.contents.show', [$course, $courseContent]) }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    View Content
                </a>
                <a href="{{ route('admin.courses.contents.index', $course) }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Contents
                </a>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="max-w-4xl mx-auto">
        <form method="POST" action="{{ route('admin.courses.contents.update', [$course, $courseContent]) }}" class="space-y-8">
            @csrf
            @method('PUT')
            
            <!-- Basic Information -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Basic Information</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Content Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="title" 
                               name="title" 
                               value="{{ old('title', $courseContent->title) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                               placeholder="Enter content title"
                               required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Topic -->
                    <div>
                        <label for="topic_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Topic
                        </label>
                        <select id="topic_id" 
                                name="topic_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('topic_id') border-red-500 @enderror">
                            <option value="">Select Topic (Optional)</option>
                            @foreach($topics as $topic)
                                <option value="{{ $topic->id }}" {{ old('topic_id', $courseContent->topic_id) == $topic->id ? 'selected' : '' }}>
                                    {{ $topic->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('topic_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Order -->
                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                            Display Order
                        </label>
                        <input type="number" 
                               id="order" 
                               name="order" 
                               value="{{ old('order', $courseContent->order) }}"
                               min="0"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('order') border-red-500 @enderror"
                               placeholder="0">
                        <p class="mt-1 text-sm text-gray-500">Leave empty for auto-ordering</p>
                        @error('order')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror"
                                  placeholder="Brief description of this content">{{ old('description', $courseContent->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Content Type -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Content Type</h3>
                
                <div class="space-y-6">
                    <!-- Material Content -->
                    <div>
                        <label for="material_content" class="block text-sm font-medium text-gray-700 mb-2">
                            Material Content
                        </label>
                        <textarea id="material_content" 
                                  name="material_content" 
                                  rows="8"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('material_content') border-red-500 @enderror"
                                  placeholder="Write your material content here...">{{ old('material_content', $courseContent->material_content) }}</textarea>
                        @error('material_content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- YouTube Embed URL -->
                    <div>
                        <label for="youtube_embed_url" class="block text-sm font-medium text-gray-700 mb-2">
                            YouTube Video URL
                        </label>
                        <input type="url" 
                               id="youtube_embed_url" 
                               name="youtube_embed_url" 
                               value="{{ old('youtube_embed_url', $courseContent->youtube_embed_url) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('youtube_embed_url') border-red-500 @enderror"
                               placeholder="https://www.youtube.com/watch?v=...">
                        <p class="mt-1 text-sm text-gray-500">Paste the full YouTube video URL</p>
                        @error('youtube_embed_url')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Current File -->
                    @if($courseContent->file_path)
                    <div class="bg-gray-50 rounded-lg p-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current File</label>
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-sm text-gray-900">{{ $courseContent->file_name }}</span>
                            <a href="{{ Storage::url($courseContent->file_path) }}" 
                               target="_blank"
                               class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                Download
                            </a>
                        </div>
                    </div>
                    @endif

                    <!-- File Upload -->
                    <div>
                        <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $courseContent->file_path ? 'Replace File' : 'File Upload' }}
                        </label>
                        <input type="file" 
                               id="file" 
                               name="file" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('file') border-red-500 @enderror"
                               accept=".pdf,.doc,.docx,.txt,.zip,.rar">
                        <p class="mt-1 text-sm text-gray-500">PDF, DOC, DOCX, TXT, ZIP, RAR (max 10MB)</p>
                        @error('file')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Announcement -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Announcement</h3>
                
                <div>
                    <label for="announcement" class="block text-sm font-medium text-gray-700 mb-2">
                        Announcement
                    </label>
                    <textarea id="announcement" 
                              name="announcement" 
                              rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('announcement') border-red-500 @enderror"
                              placeholder="Any special announcements for this content...">{{ old('announcement', $courseContent->announcement) }}</textarea>
                    @error('announcement')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Status Settings -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Status Settings</h3>
                
                <div class="space-y-4">
                    <!-- Published Status -->
                    <div class="flex items-center">
                        <input id="is_published" 
                               name="is_published" 
                               type="checkbox" 
                               value="1"
                               {{ old('is_published', $courseContent->is_published) ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_published" class="ml-2 block text-sm text-gray-900">
                            Publish this content (make it visible to students)
                        </label>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-4">
                <a href="{{ route('admin.courses.contents.index', $course) }}" 
                   class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    Update Content
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
