@extends('layouts.admin-tutor')

@section('content')
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">My Profile</h1>
                <p class="text-gray-600 mt-2">Manage your account settings and preferences</p>
            </div>
            <a href="{{ route('admin.profile.edit') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Profile
            </a>
        </div>
    </div>

    <div>
        <!-- Cover Image Section -->
        <div class="relative h-48 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg mb-6 overflow-hidden">
            @if ($user->cover_photo)
                <img src="{{ Storage::url($user->cover_photo) }}" class="absolute inset-0 w-full h-full object-cover"
                    alt="Cover Photo">
            @endif

            <!-- Cover Photo Edit Button -->
            <div class="absolute top-4 right-4">
                <button onclick="document.getElementById('cover-photo-input').click()"
                    class="bg-white bg-opacity-20 backdrop-blur-sm text-white rounded-lg px-4 py-2 hover:bg-opacity-30 transition-all duration-200 flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0118.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="text-sm font-medium">Change Cover</span>
                </button>
                <input type="file" id="cover-photo-input" class="hidden" accept="image/*">
            </div>
        </div>

        <!-- Profile Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-8 -mt-16 relative z-10">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-8">
                <div class="flex flex-col md:flex-row items-center">
                    <div class="relative mb-4 md:mb-0 md:mr-6">
                        @if ($user->avatar)
                            <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}'s avatar"
                                class="w-24 h-24 rounded-full border-4 border-white shadow-lg object-cover">
                        @else
                            <div
                                class="w-24 h-24 rounded-full border-4 border-white shadow-lg bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
                                <span class="text-3xl text-white font-bold" aria-hidden="true">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </span>
                            </div>
                        @endif

                        <!-- Tombol Edit yang Rapi -->
                        <div class="absolute -bottom-2 -right-2">
                            <a href="{{ route('admin.profile.edit') }}"
                                class="bg-white text-blue-600 rounded-full p-1.5 shadow-md hover:bg-blue-50 transition-colors flex items-center justify-center"
                                aria-label="Edit profile">
                                <!-- Ikon Pensil Edit (SVG bersih & proporsional) -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="text-center md:text-left text-white">
                        <h2 class="text-2xl font-bold mb-1">{{ $user->name }}</h2>
                        <p class="text-blue-100 text-sm mb-2">{{ $user->email }}</p>
                        @if ($user->bio)
                            <p class="text-blue-100 text-sm max-w-md">{{ $user->bio }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="p-6">
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Personal Information -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Personal Information
                        </h3>
                        <div class="space-y-4">
                            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Email</p>
                                    <p class="font-medium text-gray-900">{{ $user->email }}</p>
                                </div>
                            </div>

                            @if ($user->phone)
                                <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                    <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    <div>
                                        <p class="text-sm text-gray-500">Phone</p>
                                        <p class="font-medium text-gray-900">{{ $user->phone }}</p>
                                    </div>
                                </div>
                            @endif

                            @if ($user->date_of_birth)
                                <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                    <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <div>
                                        <p class="text-sm text-gray-500">Date of Birth</p>
                                        <p class="font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($user->date_of_birth)->format('M d, Y') }}</p>
                                    </div>
                                </div>
                            @endif

                            @if ($user->gender)
                                <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                    <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <div>
                                        <p class="text-sm text-gray-500">Gender</p>
                                        <p class="font-medium text-gray-900 capitalize">{{ $user->gender }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Learning Statistics -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Learning Statistics
                        </h3>
                        <div class="space-y-4">
                            <div class="flex items-center p-4 bg-blue-50 rounded-lg">
                                <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-600">Enrolled Courses</p>
                                    <p class="text-2xl font-bold text-blue-600">{{ $user->enrollments->count() }}</p>
                                </div>
                            </div>

                            <div class="flex items-center p-4 bg-green-50 rounded-lg">
                                <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-600">Completed Courses</p>
                                    <p class="text-2xl font-bold text-green-600">
                                        {{ $user->enrollments->where('status', 'completed')->count() }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center p-4 bg-yellow-50 rounded-lg">
                                <svg class="w-5 h-5 text-yellow-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-600">Learning Hours</p>
                                    <p class="text-2xl font-bold text-yellow-600">
                                        {{ $user->enrollments->sum('learning_hours') }}h
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center p-4 bg-purple-50 rounded-lg">
                                <svg class="w-5 h-5 text-purple-600 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-600">Average Progress</p>
                                    <p class="text-2xl font-bold text-purple-600">
                                        {{ round($user->enrollments->avg('progress') ?? 0) }}%
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($user->address)
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Address
                        </h3>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-gray-900">{{ $user->address }}</p>
                        </div>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('admin.profile.edit') }}"
                        class="flex-1 bg-gray-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-gray-700 transition-colors duration-200 text-center">
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Handle cover photo upload
        document.getElementById('cover-photo-input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Create form data
                const formData = new FormData();
                formData.append('cover_photo', file);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content'));

                // Show loading state
                const button = document.querySelector('button[onclick*="cover-photo-input"]');
                const originalText = button.innerHTML;
                button.innerHTML =
                    '<svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg><span class="text-sm font-medium ml-2">Uploading...</span>';
                button.disabled = true;

                // Upload file
                fetch('{{ route('admin.profile.update-cover') }}', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Reload page to show new cover photo
                            window.location.reload();
                        } else {
                            alert('Error uploading cover photo: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error uploading cover photo');
                    })
                    .finally(() => {
                        // Reset button
                        button.innerHTML = originalText;
                        button.disabled = false;
                    });
            }
        });
    </script>
@endsection
