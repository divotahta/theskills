@extends('layouts.instructor-tutor')

@section('content')
 <div x-data="{ mobileMenuOpen: false }">
     <!-- Alert Messages -->
     @if(session('success'))
         <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
             <span class="block sm:inline">{{ session('success') }}</span>
         </div>
     @endif

     @if(session('error'))
         <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
             <span class="block sm:inline">{{ session('error') }}</span>
         </div>
     @endif

     <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Edit Course</h1>
                <p class="text-gray-600 mt-2">Update course information and settings</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('instructor.courses.show', $course) }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    View Course
                </a>
                <a href="{{ route('instructor.courses.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Courses
                </a>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="max-w-4xl mx-auto">
        <form method="POST" action="{{ route('instructor.courses.update', $course) }}" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')
            
            <!-- Basic Information -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Basic Information</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Course Title -->
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Course Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="title" 
                               name="title" 
                               value="{{ old('title', $course->title) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                               placeholder="Enter course title"
                               required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Instructor -->
                    <div>
                        <label for="instructor_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Instructor <span class="text-red-500">*</span>
                        </label>
                        <select id="instructor_id" 
                                name="instructor_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('instructor_id') border-red-500 @enderror"
                                required>
                            <option value="">Select Instructor</option>
                            @foreach($instructors as $instructor)
                                <option value="{{ $instructor->id }}" {{ old('instructor_id', $course->instructor_id) == $instructor->id ? 'selected' : '' }}>
                                    {{ $instructor->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('instructor_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <select id="category_id" 
                                name="category_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('category_id') border-red-500 @enderror"
                                required>
                            <option value="">Select Category</option>
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

                    <!-- Course Level -->
                    <div>
                        <label for="course_level_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Course Level <span class="text-red-500">*</span>
                        </label>
                        <select id="course_level_id" 
                                name="course_level_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('course_level_id') border-red-500 @enderror"
                                required>
                            <option value="">Select Course Level</option>
                            @foreach($courseLevels as $level)
                                <option value="{{ $level->id }}" {{ old('course_level_id', $course->course_level_id) == $level->id ? 'selected' : '' }}>
                                    {{ $level->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('course_level_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                            Price (Rp) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               id="price" 
                               name="price" 
                               value="{{ old('price', $course->price) }}"
                               min="0"
                               step="1000"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('price') border-red-500 @enderror"
                               placeholder="0"
                               required>
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Max Students -->
                    <div>
                        <label for="max_students" class="block text-sm font-medium text-gray-700 mb-2">
                            Max Students
                        </label>
                        <input type="number" 
                               id="max_students" 
                               name="max_students" 
                               value="{{ old('max_students', $course->max_students) }}"
                               min="1"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('max_students') border-red-500 @enderror"
                               placeholder="Unlimited">
                        @error('max_students')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="mt-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Description <span class="text-red-500">*</span>
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror"
                              placeholder="Enter course description"
                              required>{{ old('description', $course->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Media Settings -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Media Settings</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Video Type -->
                    <div>
                        <label for="video_type" class="block text-sm font-medium text-gray-700 mb-2">
                            Video Type <span class="text-red-500">*</span>
                        </label>
                        <select id="video_type" 
                                name="video_type"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('video_type') border-red-500 @enderror"
                                required>
                            <option value="">Select Video Type</option>
                            <option value="youtube" {{ old('video_type', $course->video_type) == 'youtube' ? 'selected' : '' }}>YouTube</option>
                            <option value="vimeo" {{ old('video_type', $course->video_type) == 'vimeo' ? 'selected' : '' }}>Vimeo</option>
                            <option value="native" {{ old('video_type', $course->video_type) == 'native' ? 'selected' : '' }}>Native Upload</option>
                        </select>
                        @error('video_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Video URL -->
                    <div>
                        <label for="video_url" class="block text-sm font-medium text-gray-700 mb-2">
                            Video URL <span class="text-red-500">*</span>
                        </label>
                        <input type="url" 
                               id="video_url" 
                               name="video_url" 
                               value="{{ old('video_url', $course->video_url) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('video_url') border-red-500 @enderror"
                               placeholder="https://www.youtube.com/watch?v=..."
                               required>
                        @error('video_url')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Current Thumbnail -->
                @if($course->thumbnail)
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Thumbnail</label>
                    <div class="flex items-center space-x-4">
                        <img src="{{ Storage::url($course->thumbnail) }}" 
                             alt="Current thumbnail" 
                             class="w-20 h-20 object-cover rounded-lg border border-gray-200">
                        <div>
                            <p class="text-sm text-gray-600">Current thumbnail</p>
                            <p class="text-xs text-gray-500">Upload a new image to replace</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Thumbnail Upload -->
                <div class="mt-6">
                    <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $course->thumbnail ? 'New Thumbnail' : 'Course Thumbnail' }}
                    </label>
                    
                    <!-- Preview Container -->
                    <div id="thumbnail-preview" class="hidden mb-4">
                        <div class="relative inline-block">
                            <img id="preview-image" src="" alt="Thumbnail preview" class="w-48 h-32 object-cover rounded-lg border border-gray-200">
                            <button type="button" id="remove-preview" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm hover:bg-red-600 transition-colors">
                                ×
                            </button>
                        </div>
                    </div>
                    
                    <!-- Upload Area -->
                    <div id="upload-area" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors">
                        <div class="space-y-1 text-center">
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
                             <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                        </div>
                    </div>
                    @error('thumbnail')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Course Settings -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Course Settings</h3>
                
                <div class="space-y-4">
                    <!-- Public Course -->
                    <div class="flex items-center">
                        <input id="is_public" 
                               name="is_public" 
                               type="checkbox" 
                               value="1"
                               {{ old('is_public', $course->is_public) ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_public" class="ml-2 block text-sm text-gray-900">
                            Make this course public (visible to all students)
                        </label>
                    </div>

                    <!-- Featured Course -->
                    <div class="flex items-center">
                        <input id="is_featured" 
                               name="is_featured" 
                               type="checkbox" 
                               value="1"
                               {{ old('is_featured', $course->is_featured ?? false) ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_featured" class="ml-2 block text-sm text-gray-900">
                            Feature this course on homepage
                        </label>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-4">
                <a href="{{ route('instructor.courses.index') }}" 
                   class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    Update Course
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const thumbnailInput = document.getElementById('thumbnail');
    const previewContainer = document.getElementById('thumbnail-preview');
    const previewImage = document.getElementById('preview-image');
    const uploadArea = document.getElementById('upload-area');
    const removePreviewBtn = document.getElementById('remove-preview');

    // Handle file input change
    thumbnailInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        
        if (file) {
            // Validate file type
            if (!file.type.startsWith('image/')) {
                alert('Please select an image file.');
                return;
            }
            
             // Validate file size (10MB)
             if (file.size > 10 * 1024 * 1024) {
                 alert('File size must be less than 10MB.');
                 return;
             }
            
            // Create preview
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('hidden');
                uploadArea.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    // Handle remove preview
    removePreviewBtn.addEventListener('click', function() {
        thumbnailInput.value = '';
        previewContainer.classList.add('hidden');
        uploadArea.classList.remove('hidden');
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
