<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Beranda') }}
            </h2>
            <!-- <x-button target="_blank" href="https://github.com/kamona-wd/kui-laravel-breeze" variant="black"
                class="justify-center max-w-xs gap-2">
                <x-icons.github class="w-6 h-6" aria-hidden="true" />
                <span>Star on Github</span>
            </x-button> -->
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md mb-2">
       <!-- This is an example component -->
<div id="wrapper" class="max-w-xl px-4 py-4 mx-auto">
    <div class="sm:grid sm:h-32 sm:grid-flow-row sm:gap-4 sm:grid-cols-3">
        <div id="jh-stats-negative" class="flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-gray-300 rounded sm:mt-0">
            <div>
                <div>
                    <p class="flex items-center justify-end text-red-500 text-md">
                        {{-- <span class="font-bold">6%</span> --}}
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M20 9a1 1 0 012 0v8a1 1 0 01-1 1h-8a1 1 0 010-2h5.59L13 10.41l-3.3 3.3a1 1 0 01-1.4 0l-6-6a1 1 0 011.4-1.42L9 11.6l3.3-3.3a1 1 0 011.4 0l6.3 6.3V9z"/></svg> --}}
                    </p>
                </div>
                <p class="text-3xl font-semibold text-center text-gray-800">{{ $kelas }}</p>
                <p class="text-lg text-center text-gray-500">Kelas</p>
            </div>
        </div>

        <div id="jh-stats-neutral" class="flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-gray-300 rounded sm:mt-0">
            <div>
                <div>
                    <p class="flex items-center justify-end text-gray-500 text-md">
                        {{-- <span class="font-bold">0%</span> --}}
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M17 11a1 1 0 010 2H7a1 1 0 010-2h10z"/></svg> --}}
                    </p>
                </div>
                <p class="text-3xl font-semibold text-center text-gray-800">{{ $materi }}</p>
                <p class="text-lg text-center text-gray-500">Materi</p>
            </div>
        </div>

        <div id="jh-stats-neutral" class="flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-gray-300 rounded sm:mt-0">
            <div>
                <div>
                    <p class="flex items-center justify-end text-gray-500 text-md">
                        {{-- <span class="font-bold">0%</span> --}}
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M17 11a1 1 0 010 2H7a1 1 0 010-2h10z"/></svg> --}}
                    </p>
                </div>
                <p class="text-3xl font-semibold text-center text-gray-800">{{ $submateri }}</p>
                <p class="text-lg text-center text-gray-500">Sub Materi</p>
            </div>
        </div>
    </div>
</div>
    </div>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md mb-2">
        <div id="wrapper" class="max-w-xl px-4 py-4 mx-auto">
    <div id="jh-stats-positive" class="flex flex-col justify-center px-4 py-4 bg-white border border-gray-300 rounded">
        <div>
            <div>
                <p class="flex items-center justify-end text-green-500 text-md">
                    {{-- <span class="font-bold">6%</span> --}}
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M20 15a1 1 0 002 0V7a1 1 0 00-1-1h-8a1 1 0 000 2h5.59L13 13.59l-3.3-3.3a1 1 0 00-1.4 0l-6 6a1 1 0 001.4 1.42L9 12.4l3.3 3.3a1 1 0 001.4 0L20 9.4V15z"/></svg> --}}
                </p>
            </div>
            <p class="text-3xl font-semibold text-center text-gray-800">{{ $siswa }}</p>
            <p class="text-lg text-center text-gray-500">Jumlah Siswa</p>
        </div>
    </div>
    </div>
</div>
</x-app-layout>
