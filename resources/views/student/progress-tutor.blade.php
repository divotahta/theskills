@extends('layouts.student-tutor')

@section('content')
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Learning Progress</h1>
                <p class="text-gray-600 mt-2">Track your learning journey and achievements</p>
            </div>
        </div>
    </div>

    <!-- Progress Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Courses -->
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
                    <h3 class="text-lg font-semibold text-gray-900">Total Courses</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ $totalCourses }}</p>
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
                    <h3 class="text-lg font-semibold text-gray-900">In Progress</h3>
                    <p class="text-3xl font-bold text-yellow-600">{{ $inProgressCourses }}</p>
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
                    <h3 class="text-lg font-semibold text-gray-900">Completed</h3>
                    <p class="text-3xl font-bold text-green-600">{{ $completedCourses }}</p>
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
                    <h3 class="text-lg font-semibold text-gray-900">Learning Hours</h3>
                    <p class="text-3xl font-bold text-purple-600">{{ number_format($totalLearningHours, 1) }}h</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Overall Progress -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-900">Overall Progress</h2>
            <span class="text-2xl font-bold text-blue-600">{{ $overallProgress }}%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-3">
            <div class="bg-blue-600 h-3 rounded-full transition-all duration-300" style="width: {{ $overallProgress }}%"></div>
        </div>
        <div class="flex justify-between text-sm text-gray-600 mt-2">
            <span>{{ $completedContents }} of {{ $totalContents }} contents completed</span>
        </div>
    </div>

    @if($enrollments->count() > 0)
        <!-- Course Progress List -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Course Progress</h2>
            </div>
            
            <div class="divide-y divide-gray-200">
                @foreach($enrollments as $enrollment)
                    @php
                        $course = $enrollment->course;
                        $totalCourseContents = $course->contents->count();
                        $completedCourseContents = \App\Models\ContentProgress::where('user_id', auth()->id())
                            ->whereHas('courseContent', function($query) use ($course) {
                                $query->where('course_id', $course->id);
                            })
                            ->where('is_completed', true)
                            ->count();
                        $courseProgress = $totalCourseContents > 0 ? round(($completedCourseContents / $totalCourseContents) * 100, 1) : 0;
                        $isCompleted = $completedCourseContents === $totalCourseContents && $totalCourseContents > 0;
                    @endphp
                    
                    <div class="p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-2">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $course->title }}</h3>
                                    @if($isCompleted)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Completed
                                        </span>
                                    @elseif($completedCourseContents > 0)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            In Progress
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            Not Started
                                        </span>
                                    @endif
                                </div>
                                
                                <p class="text-gray-600 mb-3">{{ $course->description }}</p>
                                
                                <div class="flex items-center space-x-4 text-sm text-gray-500">
                                    <span>By {{ $course->instructor->name }}</span>
                                    <span>•</span>
                                    <span>{{ $course->category->name }}</span>
                                    <span>•</span>
                                    <span>{{ $course->courseLevel->name }}</span>
                                </div>
                                
                                <div class="mt-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-gray-700">Progress</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $courseProgress }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-600 h-2 rounded-full transition-all duration-300" style="width: {{ $courseProgress }}%"></div>
                                    </div>
                                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                                        <span>{{ $completedCourseContents }} of {{ $totalCourseContents }} contents completed</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="ml-6">
                                <a href="{{ route('student.courses.learn', $course) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                                    @if($isCompleted)
                                        Review Course
                                    @else
                                        Continue Learning
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Activity -->
        @if($recentActivity->count() > 0)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Recent Activity</h2>
            </div>
            
            <div class="divide-y divide-gray-200">
                @foreach($recentActivity as $activity)
                    <div class="p-6">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                @if($activity->is_completed)
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                @else
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $activity->is_completed ? 'Completed' : 'Started' }}: {{ $activity->courseContent->title }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ $activity->courseContent->course->title }}
                                    @if($activity->courseContent->topic)
                                        • {{ $activity->courseContent->topic->title }}
                                    @endif
                                </p>
                            </div>
                            <div class="flex-shrink-0 text-sm text-gray-500">
                                {{ $activity->updated_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Certificates -->
        @if($certificates->count() > 0)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Certificates Earned</h2>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($certificates as $certificate)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">{{ $certificate->course->title }}</h3>
                                    <p class="text-sm text-gray-500">Certificate #{{ $certificate->certificate_number }}</p>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500">Issued on {{ $certificate->issued_at->format('M d, Y') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

    @else
        <!-- Empty State -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6">
                <div class="text-center py-12">
                    <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No courses in progress</h3>
                    <p class="text-gray-500 mb-6">Start your learning journey by enrolling in a course</p>
                    <a href="{{ route('student.courses.browse') }}" 
                       class="inline-flex items-center px-6 py-3 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Browse Courses
                    </a>
                </div>
            </div>
        </div>
    @endif
@endsection