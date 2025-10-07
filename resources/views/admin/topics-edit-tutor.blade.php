@extends('layouts.admin-tutor')

@section('content')
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Edit Topic</h1>
                <p class="text-gray-600 mt-2">Update topic information and settings</p>
            </div>
            <a href="{{ route('admin.topics.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Topics
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="max-w-2xl">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <form method="POST" action="{{ route('admin.topics.update', $topic) }}">
                @csrf
                @method('PUT')
                
                <div class="p-6 space-y-6">
                    <!-- Course Selection -->
                    <div>
                        <label for="course_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Course <span class="text-red-500">*</span>
                        </label>
                        <select id="course_id" 
                                name="course_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('course_id') border-red-500 @enderror"
                                required>
                            <option value="">Select a Course</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ old('course_id', $topic->course_id) == $course->id ? 'selected' : '' }}>
                                    {{ $course->title }} - {{ $course->instructor->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

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
                                   placeholder="e.g., 30 minutes, 1 hour"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('duration') border-red-500 @enderror">
                            @error('duration')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="bg-gray-50 px-6 py-4 flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.topics.index') }}" 
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
