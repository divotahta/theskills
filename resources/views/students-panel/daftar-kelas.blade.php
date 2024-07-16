<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight ">
            {{ $title }}
        </h2>
    </x-slot>


<div class="mt-5 relative overflow-x-auto shadow-md sm:rounded-lg">
<div class="flex flex-wrap">
    @foreach ($kelas as $number => $row)
    <div class="max-w-sm w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-4">
    <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 h-80">
        <a href="{{ route('panel-siswa.daftarMateri', ['id' => $row->id]) }}"> 
            <img src="{{ asset('storage/' . $row->thumbnail_location) }}" alt="Image" class="w-full h-40 object-cover">
        </a>
        <div class="p-5">
            <a href="{{ route('panel-siswa.daftarMateri', ['id' => $row->id]) }}"> 
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">{{$row->name}}</h5>
            </a>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$row->description}}</p>
        </div>
    </div>
</div>

    @endforeach
</div>





</div>


</x-app-layout>