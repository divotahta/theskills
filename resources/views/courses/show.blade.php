<x-main-layout>
    <div class="bg-gray-100 min-h-screen">
        <!-- Course Header -->
        <div class="bg-white border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="grid grid-cols-3 gap-8">
                    <!-- Course Info -->
                    <div class="col-span-2">
                        <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $course->title }}</h1>
                        <div class="flex items-center space-x-4 text-sm text-gray-500 mb-4">
                            <span>{{ $course->category->name }}</span>
                            <span>•</span>
                            <span>{{ $course->difficulty_level }}</span>
                            <span>•</span>
                            <span>{{ $course->topics->count() }} topics</span>
                        </div>
                        <p class="text-gray-600 mb-6">{{ $course->description }}</p>
                        <div class="flex items-center space-x-4">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($course->instructor->name) }}" 
                                 alt="{{ $course->instructor->name }}"
                                 class="h-12 w-12 rounded-full">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $course->instructor->name }}</p>
                                <p class="text-sm text-gray-500">Instructor</p>
                            </div>
                        </div>
                    </div>

                    <!-- Course Card -->
                    <div class="bg-white rounded-lg shadow-sm p-6 h-fit">
                        @if($course->thumbnail)
                            <div class="aspect-video bg-gray-100 rounded-lg overflow-hidden mb-4">
                                <img src="{{ Storage::url($course->thumbnail) }}" 
                                     alt="{{ $course->title }}" 
                                     class="w-full h-full object-cover">
                            </div>
                        @endif
                        <div class="text-center mb-6">
                            <p class="text-3xl font-bold text-gray-900">${{ number_format($course->price, 2) }}</p>
                        </div>
                        @auth
                            @if(auth()->user()->role === 'student')
                                <form action="{{ route('student.enrollments.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <button type="submit" 
                                            class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium">
                                        Enroll Now
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" 
                               class="block w-full px-4 py-2 bg-blue-600 text-white text-center rounded-md hover:bg-blue-700 font-medium">
                                Login to Enroll
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Course Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-3 gap-8">
                <div class="col-span-2">
                    <!-- Course Curriculum -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Course Curriculum</h2>
                        <div class="space-y-4">
                            @foreach($course->topics as $index => $topic)
                                <div class="border rounded-lg p-4">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-lg font-medium text-gray-900">
                                            {{ $index + 1 }}. {{ $topic->title }}
                                        </h3>
                                    </div>
                                    @if($topic->description)
                                        <p class="mt-2 text-gray-600">{{ $topic->description }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Course Features -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Course Features</h2>
                        <ul class="space-y-3">
                            <li class="flex items-center text-gray-600">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $course->topics->count() }} topics
                            </li>
                            <li class="flex items-center text-gray-600">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Difficulty: {{ ucfirst($course->difficulty_level) }}
                            </li>
                            @if($course->max_students)
                                <li class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    Maximum {{ $course->max_students }} students
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-main-layout> 