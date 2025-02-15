<x-student-layout>
    @section('header')
        Dashboard
    @endsection

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Enrolled Courses Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-500 bg-opacity-75">
                                <svg class="h-8 w-8 text-white" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M26.25 2.625H1.75C0.783502 2.625 0 3.4085 0 4.375V23.625C0 24.5915 0.783502 25.375 1.75 25.375H26.25C27.2165 25.375 28 24.5915 28 23.625V4.375C28 3.4085 27.2165 2.625 26.25 2.625Z" fill="currentColor"/>
                                </svg>
                            </div>
                            <div class="mx-5">
                                <h4 class="text-2xl font-semibold text-gray-700">{{ $enrolledCourses->count() }}</h4>
                                <div class="text-gray-500">Enrolled Courses</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Completed Courses Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-500 bg-opacity-75">
                                <svg class="h-8 w-8 text-white" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14 0C6.26875 0 0 6.26875 0 14C0 21.7313 6.26875 28 14 28C21.7313 28 28 21.7313 28 14C28 6.26875 21.7313 0 14 0ZM21 15H15V21H13V15H7V13H13V7H15V13H21V15Z" fill="currentColor"/>
                                </svg>
                            </div>
                            <div class="mx-5">
                                <h4 class="text-2xl font-semibold text-gray-700">{{ $completedCourses }}</h4>
                                <div class="text-gray-500">Completed Courses</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Certificates Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-500 bg-opacity-75">
                                <svg class="h-8 w-8 text-white" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14 0C6.26875 0 0 6.26875 0 14C0 21.7313 6.26875 28 14 28C21.7313 28 28 21.7313 28 14C28 6.26875 21.7313 0 14 0ZM15.5 19.25H12.5V8.75H15.5V19.25Z" fill="currentColor"/>
                                </svg>
                            </div>
                            <div class="mx-5">
                                <h4 class="text-2xl font-semibold text-gray-700">{{ $totalCertificates }}</h4>
                                <div class="text-gray-500">Certificates Earned</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enrolled Courses -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-700">My Courses</h3>
                        <a href="#" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Browse Courses</a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($enrolledCourses as $enrollment)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="p-4">
                                <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $enrollment->course->title }}</h4>
                                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($enrollment->course->description, 100) }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $enrollment->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ ucfirst($enrollment->status) }}
                                    </span>
                                    <a href="#" class="text-blue-600 hover:text-blue-800">Continue Learning</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-student-layout> 