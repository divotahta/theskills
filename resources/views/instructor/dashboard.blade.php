<x-instructor-layout>
    @section('header')
        Dashboard
    @endsection

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Total Courses Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-500 bg-opacity-75">
                                <svg class="h-8 w-8 text-white" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M26.25 2.625H1.75C0.783502 2.625 0 3.4085 0 4.375V23.625C0 24.5915 0.783502 25.375 1.75 25.375H26.25C27.2165 25.375 28 24.5915 28 23.625V4.375C28 3.4085 27.2165 2.625 26.25 2.625Z" fill="currentColor"/>
                                </svg>
                            </div>
                            <div class="mx-5">
                                <h4 class="text-2xl font-semibold text-gray-700">{{ $totalCourses }}</h4>
                                <div class="text-gray-500">Total Courses</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Students Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-500 bg-opacity-75">
                                <svg class="h-8 w-8 text-white" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14 0C6.26875 0 0 6.26875 0 14C0 21.7313 6.26875 28 14 28C21.7313 28 28 21.7313 28 14C28 6.26875 21.7313 0 14 0ZM21 15H15V21H13V15H7V13H13V7H15V13H21V15Z" fill="currentColor"/>
                                </svg>
                            </div>
                            <div class="mx-5">
                                <h4 class="text-2xl font-semibold text-gray-700">{{ $totalStudents }}</h4>
                                <div class="text-gray-500">Total Students</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Revenue Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-500 bg-opacity-75">
                                <svg class="h-8 w-8 text-white" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14 0C6.26875 0 0 6.26875 0 14C0 21.7313 6.26875 28 14 28C21.7313 28 28 21.7313 28 14C28 6.26875 21.7313 0 14 0ZM15.5 19.25H12.5V8.75H15.5V19.25Z" fill="currentColor"/>
                                </svg>
                            </div>
                            <div class="mx-5">
                                <h4 class="text-2xl font-semibold text-gray-700">${{ number_format($totalRevenue, 2) }}</h4>
                                <div class="text-gray-500">Total Revenue</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Courses -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-700">Recent Courses</h3>
                        <a href="#" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Create Course</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-500 uppercase tracking-wider">Course</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-500 uppercase tracking-wider">Students</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-500 uppercase tracking-wider">Revenue</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <div class="flex items-center">
                                            <div>
                                                <div class="text-sm leading-5 font-medium text-gray-900">Sample Course</div>
                                                <div class="text-sm leading-5 text-gray-500">Web Development</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <div class="text-sm leading-5 text-gray-900">150</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <div class="text-sm leading-5 text-gray-900">$1,500</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Published
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-instructor-layout> 