<x-app-layout>
    <!-- Header Banner dengan Background -->
    <div class="relative h-64 bg-gradient-to-r from-purple-600 to-blue-600 overflow-hidden">
        <!-- Pattern Background -->
        <div class="absolute inset-0">
            <svg class="w-full h-full text-white/10" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 0 L50 100 L100 0 Z" fill="currentColor"></path>
                <path d="M0 100 L50 0 L100 100 Z" fill="currentColor"></path>
            </svg>
        </div>

        <!-- Cover Photo -->
        @if($instructor->cover_photo)
            <img src="{{ Storage::url($instructor->cover_photo) }}" 
                 class="absolute inset-0 w-full h-full object-cover"
                 alt="Cover Photo">
        @endif
        
        <!-- Cover Photo Edit Button -->
        <div class="absolute top-4 right-4">
            <button onclick="document.getElementById('cover-photo-input').click()" 
                    class="bg-white bg-opacity-20 backdrop-blur-sm text-white rounded-lg px-4 py-2 hover:bg-opacity-30 transition-all duration-200 flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="text-sm font-medium">Change Cover</span>
            </button>
            <input type="file" id="cover-photo-input" class="hidden" accept="image/*">
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-32">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6">
                <!-- Profile Header -->
                <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                    <!-- Profile Image -->
                    <div class="relative">
                        @if($instructor->profile_photo)
                            <img src="{{ Storage::url($instructor->profile_photo) }}" 
                                 class="w-32 h-32 rounded-full border-4 border-white shadow-lg object-cover"
                                 alt="{{ $instructor->name }}">
                        @else
                            <div class="w-32 h-32 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 border-4 border-white shadow-lg flex items-center justify-center">
                                <span class="text-white font-bold text-2xl">{{ substr($instructor->name, 0, 1) }}</span>
                            </div>
                        @endif
                        
                        <!-- Edit Profile Button -->
                        <div class="absolute -bottom-2 -right-2">
                            <a href="{{ route('instructor.profile.edit') }}" 
                               class="bg-blue-600 text-white rounded-full p-2 shadow-lg hover:bg-blue-700 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Profile Info -->
                    <div class="flex-1 text-center md:text-left">
                        <h1 class="text-2xl font-bold text-gray-900">{{ $instructor->name }}</h1>
                        <p class="text-gray-600">{{ $instructor->email }}</p>
                        
                        <!-- Stats -->
                        <div class="mt-4 flex flex-wrap justify-center md:justify-start gap-6">
                            <div>
                                <p class="text-2xl font-bold text-gray-900">{{ $instructor->courses_count }}</p>
                                <p class="text-sm text-gray-500">Kursus</p>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900">{{ $instructor->students_count }}</p>
                                <p class="text-sm text-gray-500">Siswa</p>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900">{{ $instructor->reviews_count ?? 0 }}</p>
                                <p class="text-sm text-gray-500">Ulasan</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bio -->
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Tentang Saya</h3>
                    <p class="text-gray-600">{{ $instructor->bio ?? 'Bio data is empty' }}</p>
                </div>

                <!-- Courses -->
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Kursus</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($instructor->courses as $course)
                            <div class="bg-white border rounded-lg overflow-hidden">
                                <!-- Course Thumbnail -->
                                <div class="aspect-video bg-gray-100">
                                    @if($course->thumbnail)
                                        <img src="{{ $course->thumbnail_url }}" 
                                             class="w-full h-full object-cover"
                                             alt="{{ $course->title }}">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Course Info -->
                                <div class="p-4">
                                    <h4 class="font-semibold text-gray-900 mb-2">{{ $course->title }}</h4>
                                    <p class="text-sm text-gray-600 mb-4">{{ Str::limit($course->description, 100) }}</p>
                                    
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-500">{{ $course->students_count }} siswa</span>
                                        <span class="text-sm font-semibold text-gray-900">Rp {{ number_format($course->price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-8">
                                <p class="text-gray-500">Belum ada kursus yang dibuat</p>
                            </div>
                        @endforelse
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
                fetch('{{ route("instructor.profile.update-cover") }}', {
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
</x-app-layout> 