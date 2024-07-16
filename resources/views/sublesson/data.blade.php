<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight ">
            {{ __('Data Sub Materi') }}
        </h2>
        <button
            type="button"
            onclick="window.location='{{ url('sublesson/create') }}'"
            class="float-right rounded bg-indigo-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-indigo-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-indigo-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-indigo-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
            Tambah Data
        </button>
    </x-slot>


<div class="mt-5 relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-200">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No
                </th>
                <th scope="col" class="px-6 py-3">
                    judul
                </th>
                <th scope="col" class="px-6 py-3">
                    Deskripsi
                </th>
                <th scope="col" class="px-6 py-3">
                    Dokumen PDF
                </th>
                <th scope="col" class="px-6 py-3">
                   Link Youtube
                </th>
                <th scope="col" class="px-6 py-3">
                   Materi
                </th>
                <th scope="col" class="px-6 py-3">
                    Aksi
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sublessons as $number => $row)
            <tr class="{{ $number % 2 == 0 ? 'bg-white border-b dark:bg-gray-900' : 'bg-gray-100 dark:bg-gray-800' }}">
                <th scope="s" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                {{ $number + 1 }}
                </th>
                <td class="px-6 py-4">
                {{ $row->name }}
                </td>
                <td class="px-6 py-4">
                {{ $row->description }}
                </td>
                @if (!empty($row->pdf_location))
                <td class="px-6 py-4">
                    <a href="{{ asset('storage/' . $row->pdf_location) }}" target="_blank" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Buka PDF</a>
                </td>
                @else
                <td class="px-6 py-4">
                    <a>tidak ada dokumen</a>
                </td>
                @endif
                <td class="px-6 py-4">
                    <a href="{{ 'https://www.youtube.com/watch?v=' . $row->youtube_link }}" target="_blank" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Buka Video</a>
                </td>

                <td class="px-6 py-4">
                {{ $row->lesson->name }}
                </td>
                <!-- <td class="px-6 py-4">
                <img src="{{ asset('storage/' . $row->thumbnail_location) }}" alt="Image" width="100">
                </td> -->
                <td class="px-6 py-4">
                    <div class="flex items-center">
                        <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded" onclick="window.location='{{ route('sublesson.edit',$row->id) }}'">Edit</button>
                        <form action="{{ route('sublesson.destroy',$row->id) }}" method="post">
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded ml-2" onclick="return confirm(&quot;Apakah ingin menghapus data tersebut?&quot;)">Hapus</button>
                            @csrf
                            @method('delete')
                        </form>
                    </div>
            
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


</x-app-layout>