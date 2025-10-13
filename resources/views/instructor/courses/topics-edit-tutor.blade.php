@extends('layouts.instructor-tutor')

@section('content')
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Edit Topic</h1>
                <p class="text-gray-600 mt-2">Update topic "{{ $topic->title }}" in "{{ $course->title }}"</p>
            </div>
            <a href="{{ route('instructor.courses.topics', $course) }}"
                class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Topics
            </a>
        </div>
    </div>

    <!-- Course Info Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <div class="flex items-center space-x-4">
            <div class="flex-shrink-0">
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
            </div>
            <div class="flex-1">
                <h2 class="text-lg font-semibold text-gray-900">{{ $course->title }}</h2>
                <p class="text-sm text-gray-500">Instructor: {{ $course->instructor->name }}</p>
                <div class="flex items-center space-x-4 mt-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        {{ $course->topics()->count() }} topics
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        {{ $course->contents()->count() }} contents
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="max-w-2xl">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <form method="POST" action="{{ route('instructor.courses.topics.update', [$course, $topic]) }}">
                @csrf
                @method('PUT')
                
                <div class="p-6 space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Topic Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="title" 
                               name="title" 
                               value="{{ old('title', $topic->title) }}"
                               placeholder="Enter topic title..."
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                               required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="4"
                                  placeholder="Enter topic description..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror">{{ old('description', $topic->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Order and Duration Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Order -->
                        <div>
                            <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                                Order
                            </label>
                            <input type="number" 
                                   id="order" 
                                   name="order" 
                                   value="{{ old('order', $topic->order) }}"
                                   min="0"
                                   placeholder="Auto-assign if empty"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('order') border-red-500 @enderror">
                            <p class="mt-1 text-sm text-gray-500">Leave empty to auto-assign the next order</p>
                            @error('order')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Duration -->
                        <div>
                            <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">
                                Duration
                            </label>
                            <input type="text" 
                                   id="duration" 
                                   name="duration" 
                                   value="{{ old('duration', $topic->duration) }}"
                                   placeholder="e.g., 30, 1:30, 1 hour, 90 minutes"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('duration') border-red-500 @enderror">
                            @error('duration')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="bg-gray-50 px-6 py-4 flex items-center justify-end space-x-3">
                    <a href="{{ route('instructor.courses.topics', $course) }}" 
                       class="px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                        Update Topic
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
