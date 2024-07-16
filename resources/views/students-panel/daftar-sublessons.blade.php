<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight ">
        {{ $title }}

        </h2>
    </x-slot>


<div class="mt-5 relative overflow-x-auto shadow-md sm:rounded-lg">

    @foreach ($lessons as $number => $row)
    <div class="w-full mb-2">
    <a href="{{ route('panel-siswa.getMateri', ['id' => $row->id]) }}">
        <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="p-5">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$row->name}}</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$row->description}}</p>
            </div>
        </div>
    </a>
</div>

    @endforeach






</div>


</x-app-layout>