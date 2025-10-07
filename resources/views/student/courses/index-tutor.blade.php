@extends('layouts.student-tutor')

@section('content')
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">My Courses</h1>
                <p class="text-gray-600 mt-2">Continue your learning journey</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('student.courses.browse') }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Browse More Courses
                </a>
            </div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="mb-6">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8">
                <a href="{{ route('student.courses.index') }}" 
                   class="py-2 px-1 border-b-2 font-medium text-sm {{ !request('status') ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    All Courses
                </a>
                <a href="{{ route('student.courses.index', ['status' => 'in_progress']) }}" 
                   class="py-2 px-1 border-b-2 font-medium text-sm {{ request('status') === 'in_progress' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    In Progress
                </a>
                <a href="{{ route('student.courses.index', ['status' => 'completed']) }}" 
                   class="py-2 px-1 border-b-2 font-medium text-sm {{ request('status') === 'completed' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Completed
                </a>
            </nav>
        </div>
    </div>

    <!-- Courses Grid -->
    @if($enrolledCourses->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($enrolledCourses as $enrollment)
                @php
                    $course = $enrollment->course;
                    $progress = $course->getUserProgress(auth()->id());
                @endphp
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                    <!-- Course Thumbnail -->
                    <div class="aspect-w-16 aspect-h-9">
                        @if($course->thumbnail)
                            <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Course Content -->
                    <div class="p-6">
                        <!-- Course Info -->
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">{{ $course->title }}</h3>
                            <p class="text-sm text-gray-600 mb-2">by {{ $course->instructor->name }}</p>
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                    {{ $course->topics_count }} topics
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    {{ $course->contents_count }} lessons
                                </span>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="mb-4">
                            <div class="flex items-center justify-between text-sm text-gray-600 mb-2">
                                <span>Progress</span>
                                <span>{{ $progress['percentage'] }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full transition-all duration-300" 
                                     style="width: {{ $progress['percentage'] }}%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $progress['completed'] }} of {{ $progress['total'] }} lessons completed
                            </p>
                        </div>

                        <!-- Course Level -->
                        @if($course->courseLevel)
                            <div class="mb-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $course->courseLevel->name }}
                                </span>
                            </div>
                        @endif

                        <!-- Action Button -->
                        <div class="flex items-center justify-between">
                            <a href="{{ route('student.courses.learn', $course) }}" 
                               class="flex-1 bg-blue-600 text-white text-center py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium">
                                @if($progress['completed'] > 0)
                                    Continue Learning
                                @else
                                    Start Learning
                                @endif
                            </a>
                            <a href="{{ route('student.courses.show', $course) }}" 
                               class="ml-2 p-2 text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $enrolledCourses->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No courses yet</h3>
            <p class="text-gray-500 mb-6">Start your learning journey by enrolling in a course</p>
            <a href="{{ route('student.courses.browse') }}" 
               class="inline-flex items-center px-6 py-3 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Browse Courses
            </a>
        </div>
    @endif
@endsection
