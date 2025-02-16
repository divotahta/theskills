<x-instructor-layout>
    <div x-data="{ currentStep: 'basics' }" class="min-h-screen bg-gray-50">
        <!-- Top Navigation -->
        <div class="border-b bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <div class="flex items-center space-x-8">
                        <h1 class="text-xl font-medium">Course Builder</h1>
                        <nav class="flex items-center space-x-1">
                            <button type="button" @click="currentStep = 'basics'" 
                                    :class="{ 'bg-blue-50 text-blue-700': currentStep === 'basics', 'text-gray-500 hover:text-gray-700': currentStep !== 'basics' }"
                                    class="px-3 py-2 text-sm font-medium rounded-md">
                                1
                                <span class="ml-1">Basics</span>
                            </button>
                            <span class="text-gray-300">—</span>
                            <button type="button" @click="currentStep = 'curriculum'"
                                    :class="{ 'bg-blue-50 text-blue-700': currentStep === 'curriculum', 'text-gray-500 hover:text-gray-700': currentStep !== 'curriculum' }"
                                    class="px-3 py-2 text-sm font-medium rounded-md">
                                2
                                <span class="ml-1">Curriculum</span>
                            </button>
                            <span class="text-gray-300">—</span>
                            <button type="button" @click="currentStep = 'additional'"
                                    :class="{ 'bg-blue-50 text-blue-700': currentStep === 'additional', 'text-gray-500 hover:text-gray-700': currentStep !== 'additional' }"
                                    class="px-3 py-2 text-sm font-medium rounded-md">
                                3
                                <span class="ml-1">Additional</span>
                            </button>
                        </nav>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button type="submit" name="status" value="draft" form="courseForm"
                                class="text-sm font-medium text-gray-700 flex items-center">
                            <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                            </svg>
                            Save as Draft
                        </button>
                        <button type="submit" name="status" value="published" form="courseForm"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium text-sm">
                            Publish
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="py-4">
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="progress-bar bg-blue-600 h-2.5 rounded-full transition-all duration-300" style="width: 0%"></div>
                    </div>
                    <div class="flex justify-between mt-2 text-sm text-gray-600">
                        <span>Basic</span>
                        <span>Curriculum</span>
                        <span>Additional</span>
                    </div>
                </div>
            </div>
        </div>

        <form id="courseForm" action="{{ route('instructor.courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Basics Step -->
            <div x-show="currentStep === 'basics'" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="grid grid-cols-3 gap-8">
                    <!-- Left Column (2/3) -->
                    <div class="col-span-2 space-y-6">
                        <!-- Title -->
                        <div class="bg-white rounded-lg p-6 shadow-sm">
                            <div class="space-y-4">
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                                        Title
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="title" id="title" 
                                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                                <div>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <span>Course URL: https://theskills.id/kursus/</span>
                                        <span class="text-gray-900 font-medium ml-1">course-title</span>
                                        <button type="button" class="ml-2 text-gray-400 hover:text-gray-500">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="bg-white rounded-lg p-6 shadow-sm">
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <label class="block text-sm font-medium text-gray-700">
                                        Description
                                        <span class="text-red-500">*</span>
                                    </label>
                                </div>
                                <textarea name="description" id="description" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                            </div>
                        </div>

                        <!-- Options -->
                        <div class="bg-white rounded-lg p-6 shadow-sm">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Options</h2>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Maximum Student
                                        <svg class="w-4 h-4 inline-block ml-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </label>
                                    <input type="number" min="0" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Difficulty Level
                                        <svg class="w-4 h-4 inline-block ml-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </label>
                                    <select class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <option>Beginner</option>
                                        <option>Intermediate</option>
                                        <option>Advanced</option>
                                        <option>Expert</option>
                                    </select>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="text-sm font-medium text-gray-700">Public Course</span>
                                        <svg class="w-4 h-4 ml-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <button type="button" class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 bg-gray-200">
                                        <span class="translate-x-0 inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                                    </button>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="text-sm font-medium text-gray-700">Q&A</span>
                                        <svg class="w-4 h-4 ml-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <button type="button" class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 bg-gray-200">
                                        <span class="translate-x-0 inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column (1/3) -->
                    <div class="space-y-6">
                        <!-- Visibility -->
                        <div class="bg-white rounded-lg p-6 shadow-sm">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-sm font-medium text-gray-900">Visibility</h2>
                                <select class="text-sm border-gray-300 rounded-md">
                                    <option>Public</option>
                                    <option>Private</option>
                                </select>
                            </div>
                            <div class="text-sm text-gray-500">
                                {{ date('d F, Y') }}
                            </div>
                        </div>

                        <!-- Featured Image -->
                        <div class="bg-white rounded-lg p-6 shadow-sm">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-sm font-medium text-gray-900">Featured Image</h2>
                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>

                                <!-- Upload Area -->
                                <div x-data="{ isHovered: false, preview: null }" 
                                     class="relative border-2 border-dashed rounded-lg overflow-hidden"
                                     :class="{ 'border-blue-400 bg-blue-50': isHovered, 'border-gray-300': !isHovered }">
                                    
                                    <!-- Preview Image -->
                                    <div x-show="preview" class="relative">
                                        <img :src="preview" alt="Preview" class="w-full h-48 object-cover">
                                        <button type="button" @click="preview = null; $refs.thumbnail.value = ''" 
                                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Upload Interface -->
                                    <div x-show="!preview" 
                                         @dragover.prevent="isHovered = true"
                                         @dragleave.prevent="isHovered = false"
                                         @drop.prevent="
                                            isHovered = false;
                                            if ($event.dataTransfer.files[0]) {
                                                let reader = new FileReader();
                                                reader.onload = (e) => preview = e.target.result;
                                                reader.readAsDataURL($event.dataTransfer.files[0]);
                                                $refs.thumbnail.files = $event.dataTransfer.files;
                                            }
                                         "
                                         class="p-8 text-center">
                                        <input type="file" 
                                               name="thumbnail" 
                                               x-ref="thumbnail"
                                               @change="
                                                    let file = $event.target.files[0];
                                                    if (file) {
                                                        let reader = new FileReader();
                                                        reader.onload = (e) => preview = e.target.result;
                                                        reader.readAsDataURL(file);
                                                    }
                                               "
                                               accept="image/jpeg,image/png,image/gif,image/webp"
                                               class="hidden">
                                        
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        
                                        <div class="mt-4 flex text-sm justify-center">
                                            <button type="button" 
                                                    @click="$refs.thumbnail.click()"
                                                    class="relative text-blue-600 hover:text-blue-700 font-medium focus:outline-none">
                                                <span>Upload Thumbnail</span>
                                            </button>
                                            <p class="pl-1 text-gray-500">or drag and drop</p>
                                        </div>
                                        
                                        <p class="text-xs text-gray-500 mt-2">
                                            JPEG, PNG, GIF, and WebP formats, up to 256 MB
                                        </p>
                                    </div>
                                </div>

                                @error('thumbnail')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Intro Video -->
                        <div class="bg-white rounded-lg p-6 shadow-sm">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-sm font-medium text-gray-900">Intro Video</h2>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>

                                <!-- URL Input Area -->
                                <div x-data="{ showUrlInput: false, videoUrl: '' }">
                                    <!-- Add URL Button -->
                                    <button type="button" 
                                            x-show="!showUrlInput"
                                            @click="showUrlInput = true" 
                                            class="w-full text-blue-600 text-sm font-medium hover:text-blue-700 flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Add from URL
                                    </button>

                                    <!-- URL Input Form -->
                                    <div x-show="showUrlInput" class="space-y-3">
                                        <div class="flex items-center space-x-2">
                                            <input type="url" 
                                                   name="video_url" 
                                                   x-model="videoUrl"
                                                   placeholder="Paste video URL here"
                                                   class="flex-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                            
                                            <button type="button" 
                                                    @click="showUrlInput = false; videoUrl = ''" 
                                                    class="inline-flex items-center p-1 border border-transparent rounded-full text-gray-400 hover:text-gray-500">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Video Preview -->
                                        <template x-if="videoUrl">
                                            <div class="relative bg-gray-50 rounded-lg overflow-hidden">
                                                <!-- Video Thumbnail/Preview would go here -->
                                                <div class="aspect-w-16 aspect-h-9">
                                                    <div class="flex items-center justify-center bg-gray-100">
                                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                                  d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                                  d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    </div>
                                                </div>

                                                <!-- URL Display -->
                                                <div class="p-3 bg-white border-t">
                                                    <p class="text-xs text-gray-500 truncate" x-text="videoUrl"></p>
                                                </div>
                                            </div>
                                        </template>

                                        <!-- Help Text -->
                                        <p class="text-xs text-gray-500">
                                            Supported platforms: YouTube, Vimeo
                                        </p>
                                    </div>
                                </div>

                                @error('video_url')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Pricing Model -->
                        <div class="bg-white rounded-lg p-6 shadow-sm">
                            <h2 class="text-sm font-medium text-gray-900 mb-4">Pricing Model</h2>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="pricing" value="free" checked class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Free</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="pricing" value="paid" class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Paid</span>
                                </label>
                            </div>
                        </div>

                        <!-- Category Selection -->
                        <div class="bg-white rounded-lg p-6 shadow-sm">
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <label class="block text-sm font-medium text-gray-700">
                                        Category
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <button type="button" 
                                            onclick="openCategoryModal()"
                                            class="text-sm text-blue-600 hover:text-blue-700">
                                        + Add New Category
                                    </button>
                                </div>

                                <!-- Existing Category Select -->
                                <select name="category_id" 
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Tags -->
                        <div class="bg-white rounded-lg p-6 shadow-sm">
                            <h2 class="text-sm font-medium text-gray-900 mb-4">Tags</h2>
                            <input type="text" placeholder="Add tags" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <!-- Author -->
                        <div class="bg-white rounded-lg p-6 shadow-sm">
                            <h2 class="text-sm font-medium text-gray-900 mb-4">Author</h2>
                            <div class="flex items-center">
                                <img src="https://ui-avatars.com/api/?name=Admin" alt="Author" class="w-8 h-8 rounded-full">
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">admin@theskills.id</div>
                                    <div class="text-sm text-gray-500">penggerak.sp.berinovasi@gmail.com</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-end mt-6">
                    <button type="button" 
                            onclick="nextStep()"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Next
                        <svg class="ml-2 -mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Curriculum Step -->
            <div x-show="currentStep === 'curriculum'" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="border border-gray-200 rounded-lg p-4">
                        <input type="text" name="topic_title" 
                               class="w-full border-0 border-b border-transparent bg-gray-50 focus:border-blue-500 focus:ring-0 text-gray-900 mb-4"
                               placeholder="Add a title">
                               
                        <textarea name="topic_summary" rows="2"
                                  class="w-full border-0 border-b border-transparent bg-gray-50 focus:border-blue-500 focus:ring-0 text-gray-600 resize-none mb-4"
                                  placeholder="Add a summary"></textarea>

                        <div class="flex space-x-2">
                            <button type="button" class="inline-flex items-center px-3 py-1.5 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Lesson
                            </button>
                            <button type="button" class="inline-flex items-center px-3 py-1.5 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Quiz
                            </button>
                        </div>
                    </div>

                    <button type="button" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-50 text-blue-700 text-sm font-medium rounded-md hover:bg-blue-100">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add Topic
                    </button>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between mt-6">
                    <button type="button" 
                            onclick="previousStep()"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="mr-2 -ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Previous
                    </button>
                    <button type="button" 
                            onclick="nextStep()"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Next
                        <svg class="ml-2 -mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Additional Step -->
            <div x-show="currentStep === 'additional'" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="space-y-6">
                    <!-- Overview -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-base font-medium text-gray-900 mb-1">Overview</h3>
                        <p class="text-sm text-gray-500 mb-4">Provide essential course information to attract and inform potential students</p>
                        <textarea name="overview" rows="4" 
                                  class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                  placeholder="Write an overview of your course"></textarea>
                    </div>

                    <!-- What Will I Learn? -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-base font-medium text-gray-900 mb-1">What Will I Learn?</h3>
                        <textarea name="learning_objectives" rows="4" 
                                  class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                  placeholder="Define the key takeaways from this course (list one benefit per line)"></textarea>
                    </div>

                    <!-- Target Audience -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-base font-medium text-gray-900 mb-1">Target Audience</h3>
                        <textarea name="target_audience" rows="4" 
                                  class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                  placeholder="Specify the target audience that will benefit the most from the course. (One Line Per target audience)"></textarea>
                    </div>

                    <!-- Total Course Duration -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-base font-medium text-gray-900 mb-4">Total Course Duration</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <input type="number" name="duration_hours" min="0" 
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       placeholder="0">
                                <span class="mt-1 text-sm text-gray-500">hour(s)</span>
                            </div>
                            <div>
                                <input type="number" name="duration_minutes" min="0" max="59" 
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       placeholder="0">
                                <span class="mt-1 text-sm text-gray-500">min(s)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Materials Included -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-base font-medium text-gray-900 mb-1">Materials Included</h3>
                        <textarea name="materials_included" rows="4" 
                                  class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                  placeholder="A list of assets you will be providing for the students in this course (One Per Line)"></textarea>
                    </div>

                    <!-- Requirements/Instructions -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-base font-medium text-gray-900 mb-1">Requirements/Instructions</h3>
                        <textarea name="requirements" rows="4" 
                                  class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                  placeholder="Additional requirements or special instructions for the students (One Per Line)"></textarea>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between mt-6">
                        <button type="button" 
                                onclick="previousStep()"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="mr-2 -ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            Previous
                        </button>
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Save Course
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Category Modal -->
    <div id="categoryModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Add New Category
                            </h3>
                            <div class="mt-4 space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Category Name</label>
                                    <input type="text" 
                                           id="new_category_name"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Description</label>
                                    <textarea id="new_category_description"
                                              rows="3" 
                                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" 
                            onclick="saveNewCategory()"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Save
                    </button>
                    <button type="button" 
                            onclick="closeCategoryModal()"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-instructor-layout>

@push('scripts')
<script>
function openCategoryModal() {
    document.getElementById('categoryModal').classList.remove('hidden');
}

function closeCategoryModal() {
    document.getElementById('categoryModal').classList.add('hidden');
    // Reset form
    document.getElementById('new_category_name').value = '';
    document.getElementById('new_category_description').value = '';
}

function saveNewCategory() {
    const name = document.getElementById('new_category_name').value;
    const description = document.getElementById('new_category_description').value;

    if (!name.trim()) {
        alert('Category name is required');
        return;
    }

    fetch('{{ route("instructor.categories.store") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ name, description })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Add new option to select
            const select = document.querySelector('[name="category_id"]');
            const option = new Option(data.category.name, data.category.id, true, true);
            select.add(option);
            
            // Close modal and reset form
            closeCategoryModal();
            
            // Show success message
            alert('Category created successfully!');
        } else {
            alert(data.message || 'Failed to create category');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to create category');
    });
}

// Close modal when clicking outside
document.getElementById('categoryModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeCategoryModal();
    }
});

// Close modal with ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && !document.getElementById('categoryModal').classList.contains('hidden')) {
        closeCategoryModal();
    }
});

let currentStep = 1;
const totalSteps = 3;

function nextStep() {
    if (currentStep < totalSteps) {
        document.querySelector(`#step-${currentStep}`).classList.add('hidden');
        currentStep++;
        document.querySelector(`#step-${currentStep}`).classList.remove('hidden');
        updateProgressBar();
    }
}

function previousStep() {
    if (currentStep > 1) {
        document.querySelector(`#step-${currentStep}`).classList.add('hidden');
        currentStep--;
        document.querySelector(`#step-${currentStep}`).classList.remove('hidden');
        updateProgressBar();
    }
}

function updateProgressBar() {
    const progress = ((currentStep - 1) / (totalSteps - 1)) * 100;
    document.querySelector('.progress-bar').style.width = `${progress}%`;
}
</script>
@endpush