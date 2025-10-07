@extends('layouts.student-tutor')

@section('content')
    <!-- Welcome Section -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Welcome back, {{ auth()->user()->name }}!</h1>
                    <p class="text-blue-100 mt-1">Ready to continue your learning journey?</p>
                </div>
                <div class="hidden md:block">
                    <svg class="w-16 h-16 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Enrolled Courses -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Enrolled Courses</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['enrolled'] }}</p>
                </div>
            </div>
        </div>

        <!-- In Progress -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">In Progress</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['in_progress'] }}</p>
                </div>
            </div>
        </div>

        <!-- Completed -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Completed</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['completed'] }}</p>
                </div>
            </div>
        </div>

        <!-- Learning Hours -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Learning Hours</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['learning_hours'] }}h</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Courses -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">My Courses</h2>
                    <a href="{{ route('student.courses.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                        View All →
                    </a>
                </div>
                
                @if($recentCourses->count() > 0)
                    <div class="divide-y divide-gray-200">
                        @foreach($recentCourses as $enrollment)
                            @php
                                $course = $enrollment->course;
                                $progress = $course->getUserProgress(auth()->id());
                            @endphp
                            <div class="p-6 hover:bg-gray-50">
                                <div class="flex items-start space-x-4">
                                    <!-- Course Thumbnail -->
                                    <div class="flex-shrink-0">
                                        @if($course->thumbnail)
                                            <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" class="w-16 h-16 rounded-lg object-cover">
                                        @else
                                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Course Info -->
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $course->title }}</h3>
                                        <p class="text-sm text-gray-600">by {{ $course->instructor->name }}</p>
                                        
                                        <!-- Progress Bar -->
                                        <div class="mt-3">
                                            <div class="flex items-center justify-between text-sm text-gray-600 mb-1">
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
                                    </div>
                                    
                                    <!-- Action Button -->
                                    <div class="flex-shrink-0">
                                        <a href="{{ route('student.courses.learn', $course) }}" 
                                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                            @if($progress['completed'] > 0)
                                                Continue Learning
                                            @else
                                                Start Learning
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-6 text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <p class="text-lg font-medium text-gray-900">No courses yet</p>
                        <p class="text-sm text-gray-500 mt-2">Start your learning journey by enrolling in a course</p>
                        <a href="{{ route('student.courses.browse') }}" 
                           class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                            Browse Courses
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Recent Activity -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Activity</h3>
                </div>
                
                @if($recentActivity->count() > 0)
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($recentActivity as $activity)
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-900">{{ $activity['message'] }}</p>
                                        <p class="text-xs text-gray-500">{{ $activity['course'] }}</p>
                                        <p class="text-xs text-gray-400">{{ $activity['time'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="p-6 text-center">
                        <svg class="w-12 h-12 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <p class="text-sm text-gray-500">No recent activity</p>
                    </div>
                @endif
            </div>

            <!-- Recommended Courses -->
            @if($recommendedCourses->count() > 0)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Recommended for You</h3>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($recommendedCourses as $course)
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        @if($course->thumbnail)
                                            <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" class="w-12 h-12 rounded-lg object-cover">
                                        @else
                                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-medium text-gray-900 truncate">{{ $course->title }}</h4>
                                        <p class="text-xs text-gray-500">{{ $course->instructor->name }}</p>
                                        <p class="text-xs text-gray-600">Rp {{ number_format($course->price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-4">
                            <a href="{{ route('student.courses.browse') }}" 
                               class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm font-medium transition-colors">
                                View All Courses
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
