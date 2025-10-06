<x-instructor-layout>
    <div x-data="{ currentStep: 'basics' }" class="min-h-screen bg-gray-50">
        <!-- Top Navigation -->
        <div class="border-b bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <div class="flex items-center space-x-8">
                        <h1 class="text-xl font-medium">Edit Course</h1>
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
                        <button type="submit" form="courseForm" name="status" value="draft" 
                                class="text-sm font-medium text-gray-700 flex items-center">
                            <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                            </svg>
                            Save as Draft
                        </button>
                        <button type="submit" form="courseForm" name="status" value="published"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium text-sm">
                            Update Course
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <form id="courseForm" action="{{ route('instructor.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Basics Step -->
            <div x-show="currentStep === 'basics'" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="grid grid-cols-3 gap-8">
                    <!-- Left Column (2/3) -->
                    <div class="col-span-2 space-y-6">
                        <!-- Title -->
                        <div class="bg-white rounded-lg p-6 shadow-sm">
                            <h3 class="text-base font-medium text-gray-900 mb-4">Basic Information</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                                        Course Title
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="title" id="title" 
                                           value="{{ old('title', $course->title) }}"
                                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    @error('title')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                        Description
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <textarea name="description" id="description" rows="6"
                                              class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $course->description) }}</textarea>
                                    @error('description')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">
                                        Category
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <div class="flex items-center space-x-2">
                                        <select name="category_id" id="category_id" 
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" 
                                                    {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="button" @click="showCategoryModal = true"
                                                class="inline-flex items-center p-2 border border-transparent rounded-full shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                    @error('category_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="bg-white rounded-lg p-6 shadow-sm">
                            <h3 class="text-base font-medium text-gray-900 mb-4">Pricing</h3>
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">
                                    Price (in USD)
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">$</span>
                                    </div>
                                    <input type="number" name="price" id="price" 
                                           value="{{ old('price', $course->price) }}"
                                           class="block w-full pl-7 rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                           step="0.01" min="0">
                                </div>
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Right Column (1/3) -->
                    <div class="space-y-6">
                        <!-- Thumbnail -->
                        <div class="bg-white rounded-lg p-6 shadow-sm">
                            <h3 class="text-base font-medium text-gray-900 mb-4">Course Thumbnail</h3>
                            <div class="space-y-4">
                                @if($course->thumbnail)
                                    <div class="aspect-video bg-gray-100 rounded-lg overflow-hidden">
                                        <img src="{{ $course->thumbnail_url }}" 
                                             alt="Course thumbnail" 
                                             class="w-full h-full object-cover">
                                    </div>
                                @endif
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Upload New Thumbnail
                                    </label>
                                    <input type="file" name="thumbnail" accept="image/*"
                                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                    @error('thumbnail')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Video -->
                        <div class="bg-white rounded-lg p-6 shadow-sm">
                            <h3 class="text-base font-medium text-gray-900 mb-4">Course Video</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Video Type</label>
                                    <select name="video_type" 
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <option value="youtube" {{ old('video_type', $course->video_type) == 'youtube' ? 'selected' : '' }}>YouTube</option>
                                        <option value="vimeo" {{ old('video_type', $course->video_type) == 'vimeo' ? 'selected' : '' }}>Vimeo</option>
                                        <option value="native" {{ old('video_type', $course->video_type) == 'native' ? 'selected' : '' }}>Native Upload</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Video URL</label>
                                    <input type="url" name="video_url" 
                                           value="{{ old('video_url', $course->video_url) }}"
                                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                            </div>
                        </div>

                        <!-- Course Settings -->
                        <div class="bg-white rounded-lg p-6 shadow-sm">
                            <h3 class="text-base font-medium text-gray-900 mb-4">Course Settings</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Video Type</label>
                                    <select name="video_type" 
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <option value="youtube" {{ old('video_type', $course->video_type) == 'youtube' ? 'selected' : '' }}>YouTube</option>
                                        <option value="vimeo" {{ old('video_type', $course->video_type) == 'vimeo' ? 'selected' : '' }}>Vimeo</option>
                                        <option value="native" {{ old('video_type', $course->video_type) == 'native' ? 'selected' : '' }}>Native</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Maximum Students</label>
                                    <input type="number" name="max_students" 
                                           value="{{ old('max_students', $course->max_students) }}"
                                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="is_public" value="1" 
                                           {{ old('is_public', $course->is_public) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label class="ml-2 block text-sm text-gray-900">Make this course public</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Curriculum Step -->
            <div x-show="currentStep === 'curriculum'" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Topics/Sections -->
                <div class="bg-white rounded-lg p-6 shadow-sm">
                    <div class="space-y-4">
                        <template x-for="(topic, index) in topics" :key="index">
                            <div class="border rounded-lg p-4">
                                <input type="text" x-model="topic.title" 
                                       :name="'topics['+index+'][title]'"
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 mb-2"
                                       placeholder="Topic Title">
                                <textarea x-model="topic.description" 
                                          :name="'topics['+index+'][description]'"
                                          class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                          placeholder="Topic Description"></textarea>
                            </div>
                        </template>
                        <button type="button" @click="topics.push({title: '', description: ''})"
                                class="mt-4 px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Add Topic
                        </button>
                    </div>
                </div>
            </div>

            <!-- Additional Step -->
            <div x-show="currentStep === 'additional'" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Video Settings -->
            </div>
        </form>

        <!-- Category Modal -->
        <div x-show="showCategoryModal" 
             class="fixed inset-0 z-50 overflow-y-auto"
             @click.away="showCategoryModal = false"
             @keydown.escape.window="showCategoryModal = false">
            <!-- ... (sama seperti di create.blade.php) ... -->
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('courseForm', () => ({
                showCategoryModal: false,
                topics: @json($course->topics),
            }))
        })
    </script>
    @endpush
</x-instructor-layout> 