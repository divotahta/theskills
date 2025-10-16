@extends('layouts.student-tutor')

@section('content')
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">My Certificates</h1>
                <p class="text-gray-600 mt-2">Download your course completion certificates</p>
            </div>
        </div>
    </div>

    @if($certificates->count() > 0)
        <!-- Certificates Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            @foreach($certificates as $certificate)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">{{ $certificate->course->title }}</h3>
                                <p class="text-sm text-gray-500">Certificate #{{ $certificate->certificate_number }}</p>
                            </div>
                        </div>
                        @if($certificate->is_valid)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Valid
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                Expired
                            </span>
                        @endif
                    </div>
                    
                    <div class="space-y-2 mb-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Category:</span>
                            <span class="text-gray-900">{{ $certificate->course->category->name }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Level:</span>
                            <span class="text-gray-900">{{ $certificate->course->courseLevel->name }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Instructor:</span>
                            <span class="text-gray-900">{{ $certificate->course->instructor->name }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Issued:</span>
                            <span class="text-gray-900">{{ $certificate->issued_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Expires:</span>
                            <span class="text-gray-900">{{ $certificate->expires_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Downloads:</span>
                            <span class="text-gray-900">{{ $certificate->download_count }}</span>
                        </div>
                    </div>
                    
                    <div class="flex space-x-2">
                        <a href="{{ route('student.certificates.download', $certificate) }}" 
                           class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download PDF
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if($completedCourses->count() > 0)
        <!-- Available Certificates Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Available Certificates</h2>
                <p class="text-gray-600 mt-1">Generate certificates for your completed courses</p>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($completedCourses as $completedCourse)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900 mb-2">{{ $completedCourse['course']->title }}</h3>
                                    <div class="space-y-1 text-sm text-gray-600">
                                        <div>Category: {{ $completedCourse['course']->category->name }}</div>
                                        <div>Level: {{ $completedCourse['course']->courseLevel->name }}</div>
                                        <div>Instructor: {{ $completedCourse['course']->instructor->name }}</div>
                                        @if($completedCourse['completed_at'])
                                            <div>Completed: {{ $completedCourse['completed_at']->format('M d, Y') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="ml-4">
                                    @if($completedCourse['has_certificate'])
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Certificate Generated
                                        </span>
                                    @else
                                        <form action="{{ route('student.certificates.generate') }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="course_id" value="{{ $completedCourse['course']->id }}">
                                            <button type="submit" 
                                                    class="inline-flex items-center px-3 py-1.5 bg-yellow-600 text-white text-sm font-medium rounded-lg hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition-colors">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                                Generate
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    @if($certificates->count() === 0 && $completedCourses->count() === 0)
        <!-- Empty State -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6">
                <div class="text-center py-12">
                    <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No certificates yet</h3>
                    <p class="text-gray-500 mb-6">Complete courses to earn certificates</p>
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