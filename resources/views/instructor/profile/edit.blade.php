<x-instructor-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Navigation Tabs -->
            <div class="border-b border-gray-200 mb-6">
                <nav class="-mb-px flex space-x-8">
                    <a href="#"
                        class="border-blue-500 text-blue-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Profile
                    </a>
                    <a href="#"
                        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Password
                    </a>
                    <a href="#"
                        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Withdraw
                    </a>
                    <a href="#"
                        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Social Profile
                    </a>
                    <a href="#"
                        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Billing
                    </a>
                </nav>
            </div>
            @if (session('status'))
            <div class="mt-6 p-4 bg-green-50 border border-green-200 rounded-md">
                <p class="text-green-600">{{ session('status') }}</p>
            </div>
        @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('instructor.profile.update') }}" enctype="multipart/form-data"
                    class="p-6">
                    @csrf
                    @method('PUT')

                    <!-- Cover Photo -->
                    <div class="relative mb-6">
                        <div class="h-48 bg-gray-100 rounded-lg overflow-hidden">
                            <img id="cover-preview"
                                src="{{ $user->cover_photo ? Storage::url($user->cover_photo) : asset('images/default-cover.jpg') }}"
                                class="w-full h-full object-cover" alt="Cover photo">
                            <button type="button" onclick="document.getElementById('cover_photo').click()"
                                class="absolute top-4 right-4 inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Upload Cover Photo
                            </button>
                        </div>
                        <input type="file" id="cover_photo" name="cover_photo" class="hidden" accept="image/*">
                    </div>

                    <!-- Profile Photo -->
                    <div class="relative -mt-16 mb-6 ml-6">
                        <div class="w-32 h-32 bg-white rounded-full overflow-hidden border-4 border-white shadow relative group">
                            <img id="profile-preview" 
                                 src="{{ $user->profile_photo ? Storage::url($user->profile_photo) : asset('images/default-avatar.jpg') }}" 
                                 class="w-full h-full object-cover" 
                                 alt="Profile photo">
                            
                            <!-- Overlay & Icon -->
                            <button type="button" 
                                    onclick="document.getElementById('profile_photo').click()" 
                                    class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </button>
                        </div>
                        <input type="file" id="profile_photo" name="profile_photo" class="hidden" accept="image/*">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- First Name -->
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" name="first_name" id="first_name"
                                value="{{ old('first_name', $user->first_name) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('first_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Last Name -->
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" name="last_name" id="last_name"
                                value="{{ old('last_name', $user->last_name) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('last_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Username</label>
                            <input type="text" id="name" value="{{ $user->name }}" disabled
                                class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 shadow-sm">
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Skill/Occupation -->
                        <div>
                            <label for="skill"
                                class="block text-sm font-medium text-gray-700">Skill/Occupation</label>
                            <input type="text" name="skill" id="skill"
                                value="{{ old('skill', $user->skill) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('skill')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Display Name -->
                        <div>
                            <label for="display_name" class="block text-sm font-medium text-gray-700">Display name
                                publicly as</label>
                            <select name="display_name" id="display_name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="{{ $user->name }}"
                                    {{ $user->display_name == $user->name ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                                <option value="{{ $user->first_name }}"
                                    {{ $user->display_name == $user->first_name ? 'selected' : '' }}>
                                    {{ $user->first_name }}
                                </option>
                                <option value="{{ $user->first_name }} {{ $user->last_name }}"
                                    {{ $user->display_name == "$user->first_name $user->last_name" ? 'selected' : '' }}>
                                    {{ $user->first_name }} {{ $user->last_name }}
                                </option>
                            </select>
                            <p class="mt-2 text-sm text-gray-500">
                                The display name is shown in all public fields, such as the author name, student name,
                                and name that will be printed on the certificate.
                            </p>
                            @error('display_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Bio -->
                    <div class="mt-6">
                        <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                        <div class="mt-1">
                            <textarea id="bio" name="bio" rows="5"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('bio', $user->bio) }}</textarea>
                        </div>
                        @error('bio')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function previewImage(input, previewId) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById(previewId).src = e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            document.getElementById('profile_photo').addEventListener('change', function() {
                previewImage(this, 'profile-preview');
            });

            document.getElementById('cover_photo').addEventListener('change', function() {
                previewImage(this, 'cover-preview');
            });
        </script>
    @endpush
</x-instructor-layout>
