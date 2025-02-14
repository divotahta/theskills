<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $course->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold mb-4">{{ $course->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ $course->description }}</p>
                        <p class="text-xl font-semibold">Rp {{ number_format($course->price) }}</p>
                    </div>

                    <div class="mb-6">
                        <h4 class="text-lg font-semibold mb-2">Materi Kursus:</h4>
                        <ul class="list-disc pl-6">
                            @foreach ($course->contents as $content)
                                <li class="mb-2">{{ $content->title }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <form action="{{ route('courses.enroll', $course) }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
                            Daftar Kursus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 