<x-instructor-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Steps -->
            <div class="mb-8">
                <div class="flex items-center justify-center">
                    <div class="flex items-center w-2/3">
                        <button type="button" class="step-button active" data-step="1">
                            <span class="step-circle">1</span>
                            <span class="step-text">Basics</span>
                        </button>
                        <div class="step-line"></div>
                        <button type="button" class="step-button" data-step="2">
                            <span class="step-circle">2</span>
                            <span class="step-text">Curriculum</span>
                        </button>
                        <div class="step-line"></div>
                        <button type="button" class="step-button" data-step="3">
                            <span class="step-circle">3</span>
                            <span class="step-text">Additional</span>
                        </button>
                    </div>
                </div>
            </div>

            <form action="{{ route('instructor.courses.store') }}" method="POST" enctype="multipart/form-data" id="courseForm">
                @csrf
                
                <!-- Step 1: Basics -->
                <div class="step-content" id="step1">
                    <!-- Basic Information -->
                    <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h2>
                        <div class="space-y-4">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">Course Title</label>
                                <input type="text" name="title" id="title" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       required>
                            </div>
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" id="description" rows="4" 
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                          required></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Course Options -->
                    <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Course Options</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="max_students" class="block text-sm font-medium text-gray-700">Maximum Students</label>
                                <input type="number" name="max_students" id="max_students" min="1"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label for="difficulty_level" class="block text-sm font-medium text-gray-700">Difficulty Level</label>
                                <select name="difficulty_level" id="difficulty_level" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="beginner">Beginner</option>
                                    <option value="intermediate">Intermediate</option>
                                    <option value="advanced">Advanced</option>
                                </select>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" name="is_public" id="is_public" 
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <label for="is_public" class="text-sm text-gray-700">Public Course</label>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" name="enable_qa" id="enable_qa" 
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <label for="enable_qa" class="text-sm text-gray-700">Enable Q&A</label>
                            </div>
                        </div>
                    </div>

                    <!-- Media -->
                    <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Media</h2>
                        <div class="space-y-6">
                            <!-- Featured Image -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Featured Image</label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md relative">
                                    <div id="imagePreview" class="hidden absolute inset-0 bg-white">
                                        <img src="" alt="Preview" class="mx-auto h-48 w-auto object-contain">
                                        <button type="button" id="removeImage" 
                                                class="absolute top-2 right-2 p-1 bg-red-100 text-red-600 rounded-full hover:bg-red-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" 
                                                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="thumbnail" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                <span>Upload a file</span>
                                                <input id="thumbnail" name="thumbnail" type="file" class="sr-only" accept="image/*">
                                            </label>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Intro Video -->
                            <div>
                                <label for="video_url" class="block text-sm font-medium text-gray-700">Intro Video URL</label>
                                <input type="url" name="video_url" id="video_url" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       placeholder="YouTube or Vimeo URL">
                            </div>
                        </div>
                    </div>

                    <!-- Categories & Tags -->
                    <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Categories & Tags</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                                <select name="category_id" id="category_id" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                                <input type="text" name="tags" id="tags" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       placeholder="Separate tags with commas">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between mt-6">
                    <button type="button" id="prevBtn" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 hidden">
                        Previous
                    </button>
                    <button type="button" id="nextBtn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Next
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        // Image Preview Handler
        const thumbnailInput = document.getElementById('thumbnail');
        const imagePreview = document.getElementById('imagePreview');
        const previewImage = imagePreview.querySelector('img');
        const removeImageBtn = document.getElementById('removeImage');

        thumbnailInput.addEventListener('change', function(e) {
            const file = this.files[0];
            if (file) {
                if (!file.type.startsWith('image/')) {
                    alert('Please select an image file');
                    return;
                }

                if (file.size > 2 * 1024 * 1024) {
                    alert('File size should be less than 2MB');
                    return;
                }

                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                };
                
                reader.readAsDataURL(file);
            }
        });

        removeImageBtn.addEventListener('click', function(e) {
            e.preventDefault();
            thumbnailInput.value = '';
            imagePreview.classList.add('hidden');
            previewImage.src = '';
        });
    </script>
    @endpush

    @push('styles')
    <style>
        .step-button {
            @apply flex flex-col items-center relative;
        }
        
        .step-circle {
            @apply w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-white font-medium;
        }
        
        .step-button.active .step-circle {
            @apply bg-blue-600;
        }
        
        .step-text {
            @apply mt-2 text-sm font-medium text-gray-500;
        }
        
        .step-button.active .step-text {
            @apply text-blue-600;
        }
        
        .step-line {
            @apply w-24 h-1 bg-gray-300 mx-4;
        }

        #imagePreview {
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
            padding: 1rem;
        }

        #imagePreview img {
            max-height: 200px;
            width: auto;
            object-fit: contain;
        }
    </style>
    @endpush
</x-instructor-layout>
