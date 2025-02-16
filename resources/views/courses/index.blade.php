<x-main-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Semua Kelas</h2>
                <p class="mt-1 text-sm text-gray-600">Pilih kelas sesuai minat dan kebutuhan Anda</p>
            </div>

            <!-- Filter Section -->
            <div class="mb-6 flex items-center space-x-4">
                <select class="rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Courses Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($courses as $course)
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        @if($course->thumbnail)
                            <img src="{{ Storage::url($course->thumbnail) }}" 
                                 alt="{{ $course->title }}" 
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        
                        <div class="p-6">
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full">
                                    {{ $course->category->name }}
                                </span>
                                <span class="px-2 py-1 text-xs font-semibold bg-gray-100 text-gray-800 rounded-full">
                                    {{ ucfirst($course->difficulty_level) }}
                                </span>
                            </div>
                            
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                <a href="{{ route('courses.show', $course) }}" class="hover:text-blue-600">
                                    {{ $course->title }}
                                </a>
                            </h3>
                            
                            <p class="text-gray-600 text-sm mb-4">
                                {{ Str::limit($course->description, 100) }}
                            </p>
                            
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($course->instructor->name) }}" 
                                         alt="{{ $course->instructor->name }}" 
                                         class="w-8 h-8 rounded-full">
                                    <span class="text-sm text-gray-600">{{ $course->instructor->name }}</span>
                                </div>
                                <span class="text-lg font-bold text-gray-900">${{ number_format($course->price, 2) }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <h3 class="text-lg font-medium text-gray-900">Tidak ada kelas tersedia</h3>
                        <p class="mt-2 text-sm text-gray-600">Silakan coba lagi nanti</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $courses->links() }}
            </div>
        </div>
    </div>
</x-main-layout> 