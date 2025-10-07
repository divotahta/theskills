@extends('layouts.student-tutor')

@section('content')
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-2 text-sm text-gray-500 mb-2">
            <a href="{{ route('student.courses.browse') }}" class="hover:text-blue-600">Browse Courses</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-gray-900">{{ $course->title }}</span>
        </div>
        <h1 class="text-3xl font-bold text-gray-900">{{ $course->title }}</h1>
        <p class="text-gray-600 mt-2">Course Details & Enrollment</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Course Thumbnail -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                @if($course->thumbnail)
                    <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" class="w-full h-64 object-cover">
                @else
                    <div class="w-full h-64 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                        <svg class="w-24 h-24 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                @endif
            </div>

            <!-- Course Information -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-6">About This Course</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="text-sm font-medium text-gray-700">Instructor</label>
                        <p class="mt-1 text-gray-900">{{ $course->instructor->name }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Category</label>
                        <p class="mt-1 text-gray-900">{{ $course->category->name }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Level</label>
                        <p class="mt-1 text-gray-900">{{ $course->courseLevel->name ?? 'Not Specified' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Students Enrolled</label>
                        <p class="mt-1 text-gray-900">{{ $course->enrollments_count }} students</p>
                    </div>
                </div>

                @if($course->description)
                    <div>
                        <label class="text-sm font-medium text-gray-700">Description</label>
                        <p class="mt-2 text-gray-900 leading-relaxed">{{ $course->description }}</p>
                    </div>
                @endif
            </div>

            <!-- Course Curriculum -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900">Course Curriculum</h3>
                    <p class="text-sm text-gray-600 mt-1">{{ $course->topics_count }} topics • {{ $course->contents_count }} lessons</p>
                </div>
                
                @if($course->topics->count() > 0)
                    <div class="divide-y divide-gray-200">
                        @foreach($course->topics->sortBy('order') as $topic)
                            <div class="p-6">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center text-white font-semibold text-sm">
                                                {{ $topic->order }}
                                            </div>
                                            <div>
                                                <h4 class="text-lg font-semibold text-gray-900">{{ $topic->title }}</h4>
                                                @if($topic->description)
                                                    <p class="text-sm text-gray-600 mt-1">{{ $topic->description }}</p>
                                                @endif
                                                <div class="flex items-center mt-2 space-x-4 text-sm text-gray-500">
                                                    <span class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        {{ $topic->duration ?? 'N/A' }} min
                                                    </span>
                                                    <span class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                        </svg>
                                                        {{ $topic->contents->count() }} lessons
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Topic Contents Preview -->
                                        @if($topic->contents->count() > 0)
                                            <div class="mt-4 ml-11">
                                                <div class="space-y-2">
                                                    @foreach($topic->contents->sortBy('order')->take(3) as $content)
                                                        <div class="flex items-center space-x-2 text-sm text-gray-600">
                                                            <div class="w-4 h-4 flex items-center justify-center">
                                                                @if($content->hasVideo())
                                                                    <svg class="w-3 h-3 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                                                        <path d="M8 5v14l11-7z"/>
                                                                    </svg>
                                                                @elseif($content->hasFile())
                                                                    <svg class="w-3 h-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                                    </svg>
                                                                @else
                                                                    <svg class="w-3 h-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                                    </svg>
                                                                @endif
                                                            </div>
                                                            <span class="truncate">{{ $content->title }}</span>
                                                        </div>
                                                    @endforeach
                                                    @if($topic->contents->count() > 3)
                                                        <div class="text-xs text-gray-500">
                                                            +{{ $topic->contents->count() - 3 }} more lessons
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-6 text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        <p class="text-lg font-medium text-gray-900">No curriculum yet</p>
                        <p class="text-sm text-gray-500">This course is still being developed</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Enrollment Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="text-center">
                    @if($course->price > 0)
                        <div class="text-3xl font-bold text-gray-900 mb-2">Rp {{ number_format($course->price, 0, ',', '.') }}</div>
                    @else
                        <div class="text-3xl font-bold text-green-600 mb-2">Free</div>
                    @endif
                    
                    @if($isEnrolled)
                        <div class="mb-4">
                            <div class="flex items-center justify-center text-sm text-gray-600 mb-2">
                                <span>Your Progress</span>
                                <span class="ml-2">{{ $progress['percentage'] }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full transition-all duration-300" 
                                     style="width: {{ $progress['percentage'] }}%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $progress['completed'] }} of {{ $progress['total'] }} lessons completed
                            </p>
                        </div>
                        
                        <a href="{{ route('student.courses.learn', $course) }}" 
                           class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium">
                            @if($progress['completed'] > 0)
                                Continue Learning
                            @else
                                Start Learning
                            @endif
                        </a>
                    @else
                        <form method="POST" action="{{ route('student.courses.enroll', $course) }}" class="w-full">
                            @csrf
                            <button type="submit" 
                                    class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium">
                                Enroll Now
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Course Stats -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Course Statistics</h3>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-700">Total Topics</span>
                        <span class="text-2xl font-bold text-gray-900">{{ $course->topics_count }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-700">Total Lessons</span>
                        <span class="text-2xl font-bold text-gray-900">{{ $course->contents_count }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-700">Students Enrolled</span>
                        <span class="text-2xl font-bold text-gray-900">{{ $course->enrollments_count }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-700">Course Level</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $course->courseLevel->name ?? 'Not Set' }}</span>
                    </div>
                </div>
            </div>

            <!-- Course Details -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Course Details</h3>
                
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Created</span>
                        <span class="text-gray-900">{{ $course->created_at->format('M j, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Last Updated</span>
                        <span class="text-gray-900">{{ $course->updated_at->format('M j, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Price</span>
                        <span class="text-gray-900 font-semibold">
                            @if($course->price > 0)
                                Rp {{ number_format($course->price, 0, ',', '.') }}
                            @else
                                Free
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status</span>
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $course->is_public ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $course->is_public ? 'Public' : 'Private' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
