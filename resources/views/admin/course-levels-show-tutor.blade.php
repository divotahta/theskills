@extends('layouts.admin-tutor')

@section('content')
<div>
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $courseLevel->name }}</h1>
                <p class="text-gray-600 mt-2">Course level details and management</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.course-levels.edit', $courseLevel) }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Course Level
                </a>
                <a href="{{ route('admin.course-levels.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Course Levels
                </a>
            </div>
        </div>
    </div>

    <!-- Course Level Overview -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Course Level Info -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-start space-x-4">
                    @if($courseLevel->color)
                        <div class="w-16 h-16 bg-{{ $courseLevel->color }}-500 rounded-xl flex items-center justify-center text-white text-2xl font-bold">
                            {{ substr($courseLevel->name, 0, 2) }}
                        </div>
                    @else
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center text-white text-2xl font-bold">
                            {{ substr($courseLevel->name, 0, 2) }}
                        </div>
                    @endif
                    
                    <div class="flex-1">
                        <div class="flex items-center space-x-3 mb-2">
                            <h2 class="text-2xl font-bold text-gray-900">{{ $courseLevel->name }}</h2>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $courseLevel->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $courseLevel->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        
                        @if($courseLevel->description)
                        <p class="text-gray-600 mb-4">{{ $courseLevel->description }}</p>
                        @endif
                        
                        <div class="flex items-center space-x-6 text-sm text-gray-500">
                            <span>Created {{ $courseLevel->created_at->format('M d, Y') }}</span>
                            <span>Updated {{ $courseLevel->updated_at->format('M d, Y') }}</span>
                            @if($courseLevel->color)
                            <div class="flex items-center space-x-1">
                                <div class="w-3 h-3 rounded-full bg-{{ $courseLevel->color }}-500"></div>
                                <span class="capitalize">{{ $courseLevel->color }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Courses in this Level -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Courses in this Level</h3>
                        <span class="text-sm text-gray-500">{{ $courseLevel->courses_count }} courses</span>
                    </div>
                </div>
                <div class="p-6">
                    @if($courseLevel->courses->count() > 0)
                        <div class="space-y-4">
                            @foreach($courseLevel->courses->take(5) as $course)
                            <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <div class="flex-shrink-0">
                                    @if($course->thumbnail)
                                        <img src="{{ Storage::url($course->thumbnail) }}" 
                                             class="w-12 h-12 rounded-lg object-cover" 
                                             alt="{{ $course->title }}">
                                    @else
                                        <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-medium text-gray-900 truncate">{{ $course->title }}</h4>
                                    <p class="text-sm text-gray-500">{{ $course->instructor->name ?? 'Unknown' }}</p>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $course->is_public ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $course->is_public ? 'Published' : 'Draft' }}
                                    </span>
                                    <span class="text-sm text-gray-500">{{ $course->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            @endforeach
                            
                            @if($courseLevel->courses->count() > 5)
                            <div class="text-center pt-4">
                                <a href="{{ route('admin.courses.index', ['level' => $courseLevel->id]) }}" 
                                   class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                    View all {{ $courseLevel->courses_count }} courses →
                                </a>
                            </div>
                            @endif
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <p class="text-gray-500">No courses in this level yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Course Level Stats -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Course Level Statistics</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Total Courses</span>
                        <span class="text-sm font-medium text-gray-900">{{ $courseLevel->courses_count }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Status</span>
                        <span class="text-sm font-medium text-gray-900">{{ $courseLevel->is_active ? 'Active' : 'Inactive' }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Sort Order</span>
                        <span class="text-sm font-medium text-gray-900">{{ $courseLevel->sort_order }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Created</span>
                        <span class="text-sm font-medium text-gray-900">{{ $courseLevel->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Last Updated</span>
                        <span class="text-sm font-medium text-gray-900">{{ $courseLevel->updated_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <form method="POST" action="{{ route('admin.course-levels.toggle-status', $courseLevel) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="w-full flex items-center justify-center px-4 py-2 {{ $courseLevel->is_active ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} text-white text-sm font-medium rounded-lg transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($courseLevel->is_active)
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"/>
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                @endif
                            </svg>
                            {{ $courseLevel->is_active ? 'Deactivate Level' : 'Activate Level' }}
                        </button>
                    </form>
                    
                    <a href="{{ route('admin.course-levels.edit', $courseLevel) }}" 
                       class="w-full flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Course Level
                    </a>

                    <form method="POST" action="{{ route('admin.course-levels.destroy', $courseLevel) }}" 
                          onsubmit="return confirm('Are you sure you want to delete this course level? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete Course Level
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
