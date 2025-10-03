<x-admin-layout>
    @section('header')
        Course Details
    @endsection

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex justify-between items-center">
                    <div>
                        <nav class="flex" aria-label="Breadcrumb">
                            <ol class="flex items-center space-x-4">
                                <li>
                                    <a href="{{ route('admin.courses.index') }}" class="text-gray-400 hover:text-gray-500">
                                        <svg class="flex-shrink-0 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                        </svg>
                                        <span class="sr-only">Courses</span>
                                    </a>
                                </li>
                                <li>
                                    <div class="flex items-center">
                                        <svg class="flex-shrink-0 h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="ml-4 text-sm font-medium text-gray-500">{{ $course->title }}</span>
                                    </div>
                                </li>
                            </ol>
                        </nav>
                        <h1 class="mt-4 text-3xl font-bold text-gray-900">{{ $course->title }}</h1>
                        <p class="mt-2 text-gray-600">Course Management & Analytics</p>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('courses.show', $course) }}" 
                           class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            View Public Page
                        </a>
                        <a href="{{ route('admin.courses.edit', $course) }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit Course
                        </a>
                    </div>
                </div>
            </div>

            <!-- Course Overview -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                <!-- Course Information -->
                <div class="lg:col-span-2">
                    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-start space-x-6">
                                @if($course->thumbnail)
                                    <img class="h-32 w-48 rounded-lg object-cover" 
                                         src="{{ Storage::url($course->thumbnail) }}" 
                                         alt="{{ $course->title }}">
                                @else
                                    <div class="h-32 w-48 rounded-lg bg-gray-200 flex items-center justify-center">
                                        <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                
                                <div class="flex-1">
                                    <div class="flex items-center space-x-4 mb-4">
                                        <span class="px-3 py-1 text-sm font-semibold bg-blue-100 text-blue-800 rounded-full">
                                            {{ $course->category->name }}
                                        </span>
                                        @if($course->is_public)
                                            <span class="px-3 py-1 text-sm font-semibold bg-green-100 text-green-800 rounded-full">
                                                Public
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-sm font-semibold bg-yellow-100 text-yellow-800 rounded-full">
                                                Private
                                            </span>
                                        @endif
                                        <span class="px-3 py-1 text-sm font-semibold bg-gray-100 text-gray-800 rounded-full">
                                            {{ ucfirst($course->video_type) }}
                                        </span>
                                    </div>
                                    
                                    <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $course->title }}</h2>
                                    <p class="text-gray-600 mb-4">{{ $course->description }}</p>
                                    
                                    <div class="grid grid-cols-2 gap-4 text-sm">
                                        <div>
                                            <span class="font-medium text-gray-700">Instructor:</span>
                                            <span class="text-gray-600">{{ $course->instructor->name }}</span>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">Price:</span>
                                            <span class="text-gray-600">${{ number_format($course->price, 2) }}</span>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">Created:</span>
                                            <span class="text-gray-600">{{ $course->created_at->format('M d, Y') }}</span>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">Last Updated:</span>
                                            <span class="text-gray-600">{{ $course->updated_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Course Topics -->
                    @if($course->topics->count() > 0)
                        <div class="bg-white shadow-sm rounded-lg mt-6">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h3 class="text-lg font-medium text-gray-900">Course Topics ({{ $course->topics->count() }})</h3>
                            </div>
                            <div class="p-6">
                                <div class="space-y-4">
                                    @foreach($course->topics as $topic)
                                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                            <div>
                                                <h4 class="font-medium text-gray-900">{{ $topic->title }}</h4>
                                                @if($topic->description)
                                                    <p class="text-sm text-gray-600 mt-1">{{ $topic->description }}</p>
                                                @endif
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                Order: {{ $topic->order ?? 'N/A' }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Course Statistics -->
                <div class="space-y-6">
                    <!-- Quick Stats -->
                    <div class="bg-white shadow-sm rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Course Statistics</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-gray-700">Total Enrollments</span>
                                <span class="text-lg font-semibold text-gray-900">{{ $course->enrollments->count() }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-gray-700">Active Enrollments</span>
                                <span class="text-lg font-semibold text-green-600">{{ $course->enrollments->where('status', 'active')->count() }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-gray-700">Completed</span>
                                <span class="text-lg font-semibold text-blue-600">{{ $course->enrollments->where('status', 'completed')->count() }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-gray-700">Course Topics</span>
                                <span class="text-lg font-semibold text-gray-900">{{ $course->topics->count() }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white shadow-sm rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Quick Actions</h3>
                        </div>
                        <div class="p-6 space-y-3">
                            <!-- Toggle Status -->
                            <form method="POST" action="{{ route('admin.courses.toggle-status', $course) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white {{ $course->is_public ? 'bg-yellow-600 hover:bg-yellow-700' : 'bg-green-600 hover:bg-green-700' }} focus:outline-none focus:ring-2 focus:ring-offset-2 {{ $course->is_public ? 'focus:ring-yellow-500' : 'focus:ring-green-500' }}">
                                    @if($course->is_public)
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                                        </svg>
                                        Make Private
                                    @else
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Make Public
                                    @endif
                                </button>
                            </form>

                            <!-- Delete Course -->
                            <form method="POST" action="{{ route('admin.courses.destroy', $course) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                        onclick="return confirm('Are you sure you want to delete this course? This action cannot be undone.')">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Delete Course
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Course Info -->
                    <div class="bg-white shadow-sm rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Course Information</h3>
                        </div>
                        <div class="p-6 space-y-3">
                            <div>
                                <span class="text-sm font-medium text-gray-700">Video Type:</span>
                                <span class="text-sm text-gray-600 ml-2">{{ ucfirst($course->video_type) }}</span>
                            </div>
                            @if($course->video_url)
                                <div>
                                    <span class="text-sm font-medium text-gray-700">Video URL:</span>
                                    <a href="{{ $course->video_url }}" target="_blank" class="text-sm text-blue-600 hover:text-blue-800 ml-2">
                                        View Video
                                    </a>
                                </div>
                            @endif
                            @if($course->max_students)
                                <div>
                                    <span class="text-sm font-medium text-gray-700">Max Students:</span>
                                    <span class="text-sm text-gray-600 ml-2">{{ $course->max_students }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enrollments Section -->
            @if($course->enrollments->count() > 0)
                <div class="bg-white shadow-sm rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-900">Enrolled Students ({{ $course->enrollments->count() }})</h3>
                            <div class="flex space-x-2">
                                <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full">
                                    Active: {{ $course->enrollments->where('status', 'active')->count() }}
                                </span>
                                <span class="px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full">
                                    Completed: {{ $course->enrollments->where('status', 'completed')->count() }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Student
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Enrolled Date
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Last Activity
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($course->enrollments as $enrollment)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                    <span class="text-sm font-medium text-gray-700">
                                                        {{ substr($enrollment->user->name, 0, 2) }}
                                                    </span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $enrollment->user->name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $enrollment->user->email }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($enrollment->status === 'active')
                                                <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full">
                                                    Active
                                                </span>
                                            @elseif($enrollment->status === 'completed')
                                                <span class="px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full">
                                                    Completed
                                                </span>
                                            @else
                                                <span class="px-2 py-1 text-xs font-semibold bg-gray-100 text-gray-800 rounded-full">
                                                    {{ ucfirst($enrollment->status) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $enrollment->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $enrollment->updated_at->format('M d, Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="bg-white shadow-sm rounded-lg">
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No enrollments yet</h3>
                        <p class="mt-1 text-sm text-gray-500">Students will appear here once they enroll in this course.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
