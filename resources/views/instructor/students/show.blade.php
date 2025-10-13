@extends('layouts.instructor-tutor')

@section('title', 'Student Details')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Student Details</h1>
                <p class="text-gray-600 mt-2">Detail dan progress siswa: {{ $student->name }}</p>
            </div>
            <a href="{{ route('instructor.students.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Students
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Student Info -->
        <div class="lg:col-span-1">
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Student Information</h2>
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-6">
                        <img class="h-20 w-20 rounded-full" 
                             src="{{ $student->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($student->name) . '&color=7F9CF5&background=EBF4FF' }}" 
                             alt="{{ $student->name }}">
                        <div class="ml-4">
                            <h3 class="text-xl font-semibold text-gray-900">{{ $student->name }}</h3>
                            <p class="text-gray-500">{{ $student->email }}</p>
                        </div>
                    </div>

                    <dl class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Phone</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $student->phone ?? 'Not provided' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Registration Date</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $student->created_at->format('d F Y') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Total Enrollments</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $enrollments->count() }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Course Progress -->
        <div class="lg:col-span-2">
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Course Progress</h2>
                </div>
                <div class="p-6">
                    @if($progressData->count() > 0)
                        <div class="space-y-6">
                            @foreach($progressData as $data)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-3">
                                        <h3 class="text-lg font-medium text-gray-900">{{ $data['enrollment']->course->title }}</h3>
                                        <span class="text-sm text-gray-500">{{ $data['progress_percentage'] }}% Complete</span>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="flex justify-between text-sm text-gray-600 mb-1">
                                            <span>Progress</span>
                                            <span>{{ $data['completed_contents'] }} / {{ $data['total_contents'] }} lessons</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $data['progress_percentage'] }}%"></div>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between text-sm text-gray-500">
                                        <span>Enrolled: {{ $data['enrollment']->created_at->format('d M Y') }}</span>
                                        <span>Status: 
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                @if($data['enrollment']->status === 'active') bg-green-100 text-green-800
                                                @elseif($data['enrollment']->status === 'completed') bg-blue-100 text-blue-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                                {{ ucfirst($data['enrollment']->status) }}
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No course enrollments</h3>
                            <p class="mt-1 text-sm text-gray-500">This student hasn't enrolled in any of your courses yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    @if($recentActivity->count() > 0)
        <div class="mt-8">
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Recent Activity</h2>
                </div>
                <div class="divide-y divide-gray-200">
                    @foreach($recentActivity as $activity)
                        <div class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        @if($activity->is_completed)
                                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        @endif
                                    </div>
                                </div>
                                <div class="ml-4 flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $activity->is_completed ? 'Completed' : 'Started' }} 
                                        {{ $activity->courseContent->title }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        {{ $activity->courseContent->course->title }} • 
                                        {{ $activity->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
