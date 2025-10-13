<x-instructor-layout>
    @section('header')
        Edit Course
    @endsection

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-4">
                        <li>
                            <a href="{{ route('instructor.courses.index') }}" class="text-gray-400 hover:text-gray-500">
                                <svg class="flex-shrink-0 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                </svg>
                                <span class="sr-only">Courses</span>
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="flex-shrink-0 h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                                <span class="ml-4 text-sm font-medium text-gray-500">Edit Course</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="mt-4 text-3xl font-bold text-gray-900">Edit Course</h1>
                <p class="mt-2 text-gray-600">Update course information and settings</p>
            </div>

            <form method="POST" action="{{ route('instructor.courses.update', $course) }}" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Course Basic Information -->
                <div class="bg-white shadow-sm rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Basic Information</h3>
                        <p class="mt-1 text-sm text-gray-600">Enter the basic details of your course.</p>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Course Title -->
                            <div class="md:col-span-2">
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Course Title *</label>
                                <input type="text" 
                                       name="title" 
                                       id="title"
                                       value="{{ old('title', $course->title) }}"
                                       required
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('title') border-red-300 @enderror"
                                       placeholder="Enter course title">
                                @error('title')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Course Description -->
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Course Description *</label>
                                <textarea name="description" 
                                          id="description" 
                                          rows="4"
                                          required
                                          class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('description') border-red-300 @enderror"
                                          placeholder="Describe what students will learn in this course">{{ old('description', $course->description) }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Instructor -->
                            <div>
                                <label for="instructor_id" class="block text-sm font-medium text-gray-700 mb-2">Instructor *</label>
                                <select name="instructor_id" 
                                        id="instructor_id"
                                        required
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('instructor_id') border-red-300 @enderror">
                                    <option value="">Select an instructor</option>
                                    @foreach($instructors as $instructor)
                                        <option value="{{ $instructor->id }}" {{ old('instructor_id', $course->instructor_id) == $instructor->id ? 'selected' : '' }}>
                                            {{ $instructor->name }} ({{ $instructor->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('instructor_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                                <select name="category_id" 
                                        id="category_id"
                                        required
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('category_id') border-red-300 @enderror">
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price ($) *</label>
                                <input type="number" 
                                       name="price" 
                                       id="price"
                                       value="{{ old('price', $course->price) }}"
                                       min="0"
                                       step="0.01"
                                       required
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('price') border-red-300 @enderror"
                                       placeholder="0.00">
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Max Students -->
                            <div>
                                <label for="max_students" class="block text-sm font-medium text-gray-700 mb-2">Maximum Students</label>
                                <input type="number" 
                                       name="max_students" 
                                       id="max_students"
                                       value="{{ old('max_students', $course->max_students) }}"
                                       min="1"
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('max_students') border-red-300 @enderror"
                                       placeholder="Leave empty for unlimited">
                                @error('max_students')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Media -->
                <div class="bg-white shadow-sm rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Course Media</h3>
                        <p class="mt-1 text-sm text-gray-600">Upload course thumbnail and video information.</p>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Thumbnail Upload with Preview & Remove Button -->
                            <div>
                                <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-2">Course Thumbnail</label>
                                
                                <!-- Current Thumbnail -->
                                @if($course->thumbnail)
                                <div class="mb-4">
                                    <p class="text-sm text-gray-600 mb-2">Current thumbnail:</p>
                                    <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Current thumbnail" class="w-32 h-20 object-cover rounded-lg border border-gray-200">
                                </div>
                                @endif
                                
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-gray-400 transition-colors relative"
                                     id="thumbnail-drop-area">
                                    <!-- Placeholder (shown when no image) -->
                                    <div class="space-y-1 text-center" id="thumbnail-placeholder">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="thumbnail" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                <span>Upload a file</span>
                                                <input id="thumbnail" name="thumbnail" type="file" class="sr-only" accept="image/*">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                    </div>
                                    <!-- Preview (hidden by default) -->
                                    <div id="thumbnail-preview" class="hidden flex flex-col items-center">
                                        <img id="thumbnail-preview-img" src="#" alt="Thumbnail preview" class="max-h-40 object-contain mb-2" />
                                        <button type="button" 
                                                id="remove-thumbnail-btn"
                                                class="mt-2 inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                            Remove
                                        </button>
                                    </div>
                                </div>
                                @error('thumbnail')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Video Information -->
                            <div class="space-y-4">
                                <div>
                                    <label for="video_type" class="block text-sm font-medium text-gray-700 mb-2">Video Type *</label>
                                    <select name="video_type" 
                                            id="video_type"
                                            required
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('video_type') border-red-300 @enderror">
                                        <option value="">Select video type</option>
                                        <option value="youtube" {{ old('video_type', $course->video_type) == 'youtube' ? 'selected' : '' }}>YouTube</option>
                                        <option value="vimeo" {{ old('video_type', $course->video_type) == 'vimeo' ? 'selected' : '' }}>Vimeo</option>
                                        <option value="native" {{ old('video_type', $course->video_type) == 'native' ? 'selected' : '' }}>Native Upload</option>
                                    </select>
                                    @error('video_type')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="video_url" class="block text-sm font-medium text-gray-700 mb-2">Video URL *</label>
                                    <input type="url" 
                                           name="video_url" 
                                           id="video_url"
                                           value="{{ old('video_url', $course->video_url) }}"
                                           required
                                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('video_url') border-red-300 @enderror"
                                           placeholder="https://www.youtube.com/watch?v=...">
                                    @error('video_url')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Settings -->
                <div class="bg-white shadow-sm rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Course Settings</h3>
                        <p class="mt-1 text-sm text-gray-600">Configure course visibility and availability.</p>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   name="is_public" 
                                   id="is_public"
                                   value="1"
                                   {{ old('is_public', $course->is_public) ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="is_public" class="ml-2 block text-sm text-gray-900">
                                Make this course public (visible to all users)
                            </label>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Uncheck to make this course private (only enrolled students can see it).</p>
                    </div>
                </div>

                <!-- Course Statistics -->
                <div class="bg-white shadow-sm rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Course Statistics</h3>
                        <p class="mt-1 text-sm text-gray-600">Current course performance metrics.</p>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-blue-600">{{ $course->enrollments_count ?? 0 }}</div>
                                <div class="text-sm text-gray-600">Students Enrolled</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-600">${{ number_format($course->enrollments_count * $course->price, 2) }}</div>
                                <div class="text-sm text-gray-600">Total Revenue</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-yellow-600">{{ $course->average_rating ?? 0 }}</div>
                                <div class="text-sm text-gray-600">Average Rating</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-purple-600">{{ $course->created_at->format('M Y') }}</div>
                                <div class="text-sm text-gray-600">Created</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('instructor.courses.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </a>
                    <a href="{{ route('instructor.courses.show', $course) }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        View Course
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Course
                    </button>
                </div>
            </form>
        </div>
    </div>

    @section('scripts')
    <!-- JavaScript: Thumbnail Preview + Remove -->
    <script>
        // Thumbnail Preview & Remove
        document.addEventListener('DOMContentLoaded', function() {
            const thumbnailInput = document.getElementById('thumbnail');
            const previewContainer = document.getElementById('thumbnail-preview');
            const previewImage = document.getElementById('thumbnail-preview-img');
            const uploadArea = document.getElementById('thumbnail-drop-area');
            const placeholder = document.getElementById('thumbnail-placeholder');
            const removeBtn = document.getElementById('remove-thumbnail-btn');

            // Handle file input change
            thumbnailInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                
                if (file) {
                    // Validate file type
                    if (!file.type.startsWith('image/')) {
                        alert('Please select an image file.');
                        return;
                    }
                    
                    // Validate file size (2MB)
                    if (file.size > 2 * 1024 * 1024) {
                        alert('File size must be less than 2MB.');
                        return;
                    }
                    
                    // Create preview
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewContainer.classList.remove('hidden');
                        placeholder.classList.add('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Handle remove preview
            removeBtn.addEventListener('click', function() {
                thumbnailInput.value = '';
                previewContainer.classList.add('hidden');
                placeholder.classList.remove('hidden');
                previewImage.src = '';
            });

            // Handle drag and drop
            uploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                uploadArea.classList.add('border-blue-400', 'bg-blue-50');
            });

            uploadArea.addEventListener('dragleave', function(e) {
                e.preventDefault();
                uploadArea.classList.remove('border-blue-400', 'bg-blue-50');
            });

            uploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                uploadArea.classList.remove('border-blue-400', 'bg-blue-50');
                
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    const file = files[0];
                    if (file.type.startsWith('image/')) {
                        // Create a new FileList with the dropped file
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        thumbnailInput.files = dataTransfer.files;
                        
                        // Trigger change event
                        const event = new Event('change', { bubbles: true });
                        thumbnailInput.dispatchEvent(event);
                    } else {
                        alert('Please drop an image file.');
                    }
                }
            });
        });
    </script>
    @endsection
</x-instructor-layout>