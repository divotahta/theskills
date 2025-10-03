<x-admin-layout>
    @section('header')
        Create New Course
    @endsection

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-4">
                        <li>
                            <a href="{{ route('admin.courses.index') }}" class="text-gray-400 hover:text-gray-500">
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
                                <span class="ml-4 text-sm font-medium text-gray-500">Create Course</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="mt-4 text-3xl font-bold text-gray-900">Create New Course</h1>
                <p class="mt-2 text-gray-600">Add a new course to the platform</p>
            </div>

            <form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data" class="space-y-8">
                @csrf

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
                                       value="{{ old('title') }}"
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
                                          placeholder="Describe what students will learn in this course">{{ old('description') }}</textarea>
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
                                        <option value="{{ $instructor->id }}" {{ old('instructor_id') == $instructor->id ? 'selected' : '' }}>
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
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                       value="{{ old('price') }}"
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
                                       value="{{ old('max_students') }}"
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
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
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
                                        <option value="youtube" {{ old('video_type') == 'youtube' ? 'selected' : '' }}>YouTube</option>
                                        <option value="vimeo" {{ old('video_type') == 'vimeo' ? 'selected' : '' }}>Vimeo</option>
                                        <option value="native" {{ old('video_type') == 'native' ? 'selected' : '' }}>Native Upload</option>
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
                                           value="{{ old('video_url') }}"
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
                                   {{ old('is_public', true) ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="is_public" class="ml-2 block text-sm text-gray-900">
                                Make this course public (visible to all users)
                            </label>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Uncheck to make this course private (only enrolled students can see it).</p>
                    </div>
                </div>

                <!-- Course Topics -->
                <div class="bg-white shadow-sm rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Course Topics</h3>
                                <p class="mt-1 text-sm text-gray-600">Add topics/lessons for this course.</p>
                            </div>
                            <button type="button" 
                                    onclick="addTopic()"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Add Topic
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <div id="topics-container" class="space-y-4">
                            <!-- Topics will be added here dynamically -->
                        </div>
                        <p class="mt-4 text-sm text-gray-500">Click "Add Topic" to add course topics. Topics will be displayed in the order they are added.</p>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.courses.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Create Course
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript: Thumbnail Preview + Remove + Topic Management -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // =============== THUMBNAIL PREVIEW & REMOVE ===============
            const thumbnailInput = document.getElementById('thumbnail');
            const previewContainer = document.getElementById('thumbnail-preview');
            const previewImage = document.getElementById('thumbnail-preview-img');
            const placeholder = document.getElementById('thumbnail-placeholder');
            const removeBtn = document.getElementById('remove-thumbnail-btn');
            const dropArea = document.getElementById('thumbnail-drop-area');

            function resetPreview() {
                previewImage.src = '#';
                previewContainer.classList.add('hidden');
                placeholder.classList.remove('hidden');
                // Clear file input
                thumbnailInput.value = '';
            }

            function showPreview(file) {
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        previewImage.src = e.target.result;
                        placeholder.classList.add('hidden');
                        previewContainer.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                } else {
                    resetPreview();
                }
            }

            // Handle file selection
            thumbnailInput.addEventListener('change', function (e) {
                showPreview(e.target.files[0]);
            });

            // Handle remove button
            removeBtn.addEventListener('click', resetPreview);

            // Optional: Drag & Drop
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, () => {
                    dropArea.classList.add('border-blue-400', 'bg-blue-50');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, () => {
                    dropArea.classList.remove('border-blue-400', 'bg-blue-50');
                }, false);
            });

            dropArea.addEventListener('drop', function (e) {
                preventDefaults(e);
                const file = e.dataTransfer.files[0];
                thumbnailInput.files = e.dataTransfer.files;
                showPreview(file);
            });

            // =============== TOPIC MANAGEMENT ===============
            let topicCount = 0;

            window.addTopic = function() {
                topicCount++;
                const container = document.getElementById('topics-container');
                const topicDiv = document.createElement('div');
                topicDiv.className = 'border border-gray-200 rounded-lg p-4 bg-gray-50';
                topicDiv.innerHTML = `
                    <div class="flex justify-between items-start mb-4">
                        <h4 class="text-sm font-medium text-gray-900">Topic ${topicCount}</h4>
                        <button type="button" onclick="removeTopic(this)" class="text-red-600 hover:text-red-800">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Topic Title *</label>
                            <input type="text" name="topics[${topicCount}][title]" required
                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Enter topic title">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Topic Description</label>
                            <textarea name="topics[${topicCount}][description]" rows="3"
                                      class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                      placeholder="Describe what will be covered in this topic"></textarea>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Order</label>
                                <input type="number" name="topics[${topicCount}][order]" value="${topicCount}" min="1"
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Duration (minutes)</label>
                                <input type="number" name="topics[${topicCount}][duration]" min="1"
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       placeholder="e.g. 15">
                            </div>
                        </div>
                    </div>
                `;
                container.appendChild(topicDiv);
            };

            window.removeTopic = function(button) {
                const container = document.getElementById('topics-container');
                if (container.children.length <= 1) {
                    alert('At least one topic is required.');
                    return;
                }
                button.closest('.border').remove();
            };

            // Initialize with one topic
            window.addTopic();
        });
    </script>
</x-admin-layout>