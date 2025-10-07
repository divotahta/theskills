@extends('layouts.admin-tutor')

@section('content')
<div>
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Course Levels</h1>
                <p class="text-gray-600 mt-2">Manage course difficulty levels</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('admin.course-levels.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Add Course Level
                </a>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Search -->
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" 
                           id="search" 
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Search course levels..." 
                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
            </div>

            <!-- Status Filter -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select id="status" 
                        name="status"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <!-- Filter Button -->
            <div class="flex items-end">
                <button type="button" 
                        onclick="applyFilters()"
                        class="w-full px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                    Apply Filters
                </button>
            </div>
        </div>
    </div>

    <!-- Course Levels Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($courseLevels as $courseLevel)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
            <!-- Course Level Header -->
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        @if($courseLevel->color)
                            <div class="w-12 h-12 bg-{{ $courseLevel->color }}-500 rounded-lg flex items-center justify-center text-white text-xl font-bold">
                                {{ substr($courseLevel->name, 0, 2) }}
                            </div>
                        @else
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center text-white text-xl font-bold">
                                {{ substr($courseLevel->name, 0, 2) }}
                            </div>
                        @endif
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $courseLevel->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $courseLevel->courses_count }} courses</p>
                        </div>
                    </div>
                    
                    <!-- Status Badge -->
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $courseLevel->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $courseLevel->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>

                <!-- Description -->
                @if($courseLevel->description)
                <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $courseLevel->description }}</p>
                @endif

                <!-- Sort Order -->
                <div class="flex items-center space-x-2 mb-4">
                    <span class="text-xs text-gray-500">Sort Order:</span>
                    <span class="text-xs text-gray-600 font-medium">{{ $courseLevel->sort_order }}</span>
                </div>

                <!-- Meta Info -->
                <div class="flex items-center justify-between text-xs text-gray-500">
                    <span>Created {{ $courseLevel->created_at->diffForHumans() }}</span>
                    <span>Updated {{ $courseLevel->updated_at->diffForHumans() }}</span>
                </div>
            </div>

            <!-- Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.course-levels.show', $courseLevel) }}" 
                           class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                            View
                        </a>
                        <a href="{{ route('admin.course-levels.edit', $courseLevel) }}" 
                           class="text-gray-600 hover:text-gray-700 text-sm font-medium">
                            Edit
                        </a>
                    </div>
                    
                    <!-- Actions Menu -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" 
                                class="p-1.5 text-gray-400 hover:text-gray-600 rounded-full hover:bg-gray-100">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                            </svg>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" x-transition
                             class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200">
                            <form method="POST" action="{{ route('admin.course-levels.toggle-status', $courseLevel) }}" class="block">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    {{ $courseLevel->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.course-levels.destroy', $courseLevel) }}" 
                                  class="block" 
                                  onsubmit="return confirm('Are you sure you want to delete this course level?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-red-50">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full">
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No course levels found</h3>
                <p class="text-gray-500 mb-6">Get started by creating your first course level.</p>
                <a href="{{ route('admin.course-levels.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Create Course Level
                </a>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($courseLevels->hasPages())
    <div class="mt-8">
        {{ $courseLevels->links() }}
    </div>
    @endif
</div>

<script>
function applyFilters() {
    const search = document.getElementById('search').value;
    const status = document.getElementById('status').value;
    
    const url = new URL(window.location);
    url.searchParams.set('search', search);
    url.searchParams.set('status', status);
    
    window.location.href = url.toString();
}
</script>
@endsection
