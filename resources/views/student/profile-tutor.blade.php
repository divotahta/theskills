@extends('layouts.student-tutor')

@section('content')
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">My Profile</h1>
                <p class="text-gray-600 mt-2">Manage your account settings and preferences</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('student.profile.edit') }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Profile
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Profile Information -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Profile Header -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center space-x-6">
                    <!-- Avatar -->
                    <div class="flex-shrink-0">
                        <div class="w-24 h-24 rounded-full overflow-hidden bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                            @if(auth()->user()->avatar)
                                <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                            @else
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Profile Info -->
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-900">{{ auth()->user()->name }}</h2>
                        <p class="text-gray-600">{{ auth()->user()->email }}</p>
                        <div class="flex items-center mt-2 space-x-4 text-sm text-gray-500">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Joined {{ auth()->user()->created_at->format('M Y') }}
                            </span>
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Student
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Personal Information -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Personal Information</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-sm font-medium text-gray-700">Full Name</label>
                        <p class="mt-1 text-gray-900">{{ auth()->user()->name }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Email Address</label>
                        <p class="mt-1 text-gray-900">{{ auth()->user()->email }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Phone Number</label>
                        <p class="mt-1 text-gray-900">{{ auth()->user()->phone ?? 'Not provided' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Date of Birth</label>
                        <p class="mt-1 text-gray-900">{{ auth()->user()->date_of_birth ? auth()->user()->date_of_birth->format('M j, Y') : 'Not provided' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Gender</label>
                        <p class="mt-1 text-gray-900">{{ ucfirst(auth()->user()->gender ?? 'Not specified') }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Location</label>
                        <p class="mt-1 text-gray-900">{{ auth()->user()->location ?? 'Not provided' }}</p>
                    </div>
                </div>

                @if(auth()->user()->bio)
                    <div class="mt-6">
                        <label class="text-sm font-medium text-gray-700">Bio</label>
                        <p class="mt-2 text-gray-900 leading-relaxed">{{ auth()->user()->bio }}</p>
                    </div>
                @endif
            </div>

            <!-- Learning Statistics -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Learning Statistics</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <p class="text-2xl font-bold text-gray-900">{{ auth()->user()->enrollments->count() }}</p>
                        <p class="text-sm text-gray-600">Enrolled Courses</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-2xl font-bold text-gray-900">
                            @php
                                $completedCourses = 0;
                                foreach(auth()->user()->enrollments as $enrollment) {
                                    $progress = $enrollment->course->getUserProgress(auth()->id());
                                    if($progress['completed'] === $progress['total'] && $progress['total'] > 0) {
                                        $completedCourses++;
                                    }
                                }
                            @endphp
                            {{ $completedCourses }}
                        </p>
                        <p class="text-sm text-gray-600">Completed Courses</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-2xl font-bold text-gray-900">
                            @php
                                $totalTime = 0;
                                foreach(auth()->user()->enrollments as $enrollment) {
                                    $courseTime = \App\Models\ContentProgress::where('user_id', auth()->id())
                                        ->whereHas('courseContent', function($query) use ($enrollment) {
                                            $query->where('course_id', $enrollment->course_id);
                                        })
                                        ->sum('time_spent');
                                    $totalTime += $courseTime;
                                }
                                $totalHours = round($totalTime / 3600, 1);
                            @endphp
                            {{ $totalHours }}h
                        </p>
                        <p class="text-sm text-gray-600">Learning Hours</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                
                <div class="space-y-3">
                    <a href="{{ route('student.profile.edit') }}" 
                       class="w-full flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Profile
                    </a>
                    <a href="{{ route('student.courses.index') }}" 
                       class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm font-medium transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        My Courses
                    </a>
                    <a href="{{ route('student.progress') }}" 
                       class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm font-medium transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        My Progress
                    </a>
                </div>
            </div>

            <!-- Account Information -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Account Information</h3>
                
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Member Since</span>
                        <span class="text-gray-900">{{ auth()->user()->created_at->format('M j, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Last Login</span>
                        <span class="text-gray-900">{{ auth()->user()->last_login_at ? auth()->user()->last_login_at->format('M j, Y g:i A') : 'Never' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Email Verified</span>
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ auth()->user()->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ auth()->user()->email_verified_at ? 'Verified' : 'Not Verified' }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Account Status</span>
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ auth()->user()->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ auth()->user()->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Activity</h3>
                
                <div class="space-y-3">
                    @php
                        $recentProgress = \App\Models\ContentProgress::where('user_id', auth()->id())
                            ->where('is_completed', true)
                            ->with(['courseContent.course'])
                            ->latest('completed_at')
                            ->limit(3)
                            ->get();
                    @endphp
                    
                    @if($recentProgress->count() > 0)
                        @foreach($recentProgress as $progress)
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-gray-900">Completed "{{ $progress->courseContent->title }}"</p>
                                    <p class="text-xs text-gray-500">{{ $progress->courseContent->course->title }}</p>
                                    <p class="text-xs text-gray-400">{{ $progress->completed_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <svg class="w-12 h-12 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <p class="text-sm text-gray-500">No recent activity</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
