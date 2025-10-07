<x-admin-layout>
    @section('header')
        Profile Details
    @endsection

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Cover Image Section -->
            <div class="relative h-48 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg mb-6 overflow-hidden">
                @if($user->cover_photo)
                    <img src="{{ Storage::url($user->cover_photo) }}" 
                         class="absolute inset-0 w-full h-full object-cover"
                         alt="Cover Photo">
                @endif
                
                <!-- Cover Photo Edit Button -->
                <div class="absolute top-4 right-4">
                    <button onclick="document.getElementById('cover-photo-input').click()" 
                            class="bg-white bg-opacity-20 backdrop-blur-sm text-white rounded-lg px-4 py-2 hover:bg-opacity-30 transition-all duration-200 flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0118.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="text-sm font-medium">Change Cover</span>
                    </button>
                    <input type="file" id="cover-photo-input" class="hidden" accept="image/*">
                </div>
            </div>

            <!-- Profile Header -->
            <div class="bg-white shadow-sm rounded-lg mb-6 -mt-16 relative z-10">
                <div class="px-6 py-8">
                    <div class="flex items-center space-x-6">
                        <div class="relative">
                            @if($user->avatar)
                                <img src="{{ Storage::url($user->avatar) }}" 
                                     class="h-20 w-20 rounded-full border-4 border-white shadow-lg object-cover"
                                     alt="{{ $user->name }}">
                            @else
                                <div class="h-20 w-20 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 border-4 border-white shadow-lg flex items-center justify-center">
                                    <span class="text-2xl font-bold text-white">
                                        {{ substr($user->name, 0, 2) }}
                                    </span>
                                </div>
                            @endif
                            
                            <!-- Edit Profile Button -->
                            <div class="absolute -bottom-1 -right-1">
                                <a href="{{ route('admin.profile.edit') }}" 
                                   class="bg-blue-600 text-white rounded-full p-2 shadow-lg hover:bg-blue-700 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                            <p class="text-gray-600">{{ $user->email }}</p>
                            <div class="mt-2 flex items-center space-x-2">
                                <span class="px-3 py-1 text-sm font-semibold bg-blue-100 text-blue-800 rounded-full">
                                    {{ ucfirst($user->role) }}
                                </span>
                                @if($user->email_verified_at)
                                    <span class="px-3 py-1 text-sm font-semibold bg-green-100 text-green-800 rounded-full">
                                        Verified
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-sm font-semibold bg-red-100 text-red-800 rounded-full">
                                        Unverified
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Information -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Personal Information -->
                <div class="bg-white shadow-sm rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Personal Information</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Full Name</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email Address</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->email }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Role</label>
                            <p class="mt-1 text-sm text-gray-900">{{ ucfirst($user->role) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Account Information -->
                <div class="bg-white shadow-sm rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Account Information</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Member Since</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->created_at->format('F d, Y') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Last Updated</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->updated_at->format('F d, Y') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email Verification</label>
                            <p class="mt-1 text-sm text-gray-900">
                                @if($user->email_verified_at)
                                    <span class="text-green-600">Verified on {{ $user->email_verified_at->format('F d, Y') }}</span>
                                @else
                                    <span class="text-red-600">Email not verified</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-6 bg-white shadow-sm rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Actions</h3>
                </div>
                <div class="p-6">
                    <div class="flex space-x-4">
                        <a href="{{ route('admin.dashboard') }}" 
                           class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Back to Dashboard
                        </a>
                    </div>
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
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                // Show loading state
                const button = document.querySelector('button[onclick*="cover-photo-input"]');
                const originalText = button.innerHTML;
                button.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg><span class="text-sm font-medium ml-2">Uploading...</span>';
                button.disabled = true;

                // Upload file
                fetch('{{ route("admin.profile.update-cover") }}', {
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
</x-admin-layout>
