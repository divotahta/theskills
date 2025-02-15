<x-instructor-layout>
    @section('header')
        My Courses
    @endsection

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header with Action Button -->
            <div class="mb-6 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Daftar Kursus</h2>
                <a href="{{ route('instructor.courses.create') }}" 
                   class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Tambah Kursus Baru
                </a>
            </div>

            <!-- Course List -->
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <div class="min-w-full divide-y divide-gray-200">
                    <!-- Table Header -->
                    <div class="bg-gray-50">
                        <div class="grid grid-cols-12 gap-4 px-6 py-3">
                            <div class="col-span-5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Judul
                            </div>
                            <div class="col-span-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </div>
                            <div class="col-span-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Siswa
                            </div>
                            <div class="col-span-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </div>
                        </div>
                    </div>

                    <!-- Table Body -->
                    <div class="bg-white divide-y divide-gray-200">
                        @forelse ($courses as $course)
                            <div class="grid grid-cols-12 gap-4 px-6 py-4 hover:bg-gray-50">
                                <div class="col-span-5">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0">
                                            @if($course->thumbnail)
                                                <img class="h-10 w-10 rounded-lg object-cover" 
                                                     src="{{ Storage::url($course->thumbnail) }}" 
                                                     alt="{{ $course->title }}">
                                            @else
                                                <div class="h-10 w-10 rounded-lg bg-gray-200 flex items-center justify-center">
                                                    <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $course->title }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ Str::limit($course->description, 50) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-3">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $course->is_public 
                                            ? 'bg-green-100 text-green-800' 
                                            : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $course->is_public ? 'Published' : 'Draft' }}
                                    </span>
                                </div>
                                <div class="col-span-2">
                                    <div class="text-sm text-gray-900">
                                        {{ $course->enrollments_count ?? 0 }} siswa
                                    </div>
                                </div>
                                <div class="col-span-2 text-right space-x-2">
                                    <a href="{{ route('instructor.courses.edit', $course->id) }}" 
                                       class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-blue-600 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Edit
                                    </a>
                                    <button type="button"
                                            class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-600 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="px-6 py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada kursus</h3>
                                <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat kursus baru.</p>
                                <div class="mt-6">
                                    <a href="{{ route('instructor.courses.create') }}" 
                                       class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        Tambah Kursus Baru
                                    </a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            @if($courses->hasPages())
                <div class="mt-4">
                    {{ $courses->links() }}
                </div>
            @endif
        </div>
    </div>
</x-instructor-layout>