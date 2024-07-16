<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight ">
            {{ __('Data Siswa') }}
        </h2>
        <button
        type="button"
        onclick="window.location='{{ url('student/create') }}'"
        class="float-right rounded bg-indigo-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-indigo-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-indigo-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-indigo-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
        Tambah Data
    </button>
    </x-slot>


<div class="mt-5 relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama Siswa
                </th>
                <th scope="col" class="px-6 py-3">
                    Course
                </th>
                <th scope="col" class="px-6 py-3">
                    Tahun Lahir
                </th>
                <th scope="col" class="px-6 py-3">
                    Sekolah
                </th>
                <th scope="col" class="px-6 py-3">
                    Kontak
                </th>
                <th scope="col" class="px-6 py-3">
                    Aksi
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $number => $row)
            <tr class="{{ $number % 2 == 0 ? 'bg-white border-b dark:bg-gray-900 dark:border-gray-700' : 'bg-gray-100 dark:bg-gray-800 dark:border-gray-700' }}">
                <th scope="s" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $number + 1 }}
                </th>
                <td class="px-6 py-4">
                {{ $row->name }}<br>
                {{ $row->addres }}
                </td>
                <td class="px-6 py-4 w-1/6">
                @foreach ($row->kelas->sortBy('name') as $number => $kelas)
                    {{ $kelas->name }}
                    <br>
                @endforeach
                </td>
                <td class="px-6 py-4">
                {{ $row->birth }}
                </td>
                <td class="px-6 py-4 w-1/6">
                    {{ $row->school_name }}<br> kelas {{ $row->grade }}
                </td>
                <td class="px-6 py-4">
                {{ $row->email }}<br>
                {{ $row->phone }}
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center"> 
                        <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded" onclick="window.location='{{ route('student.edit',$row->id) }}'">Edit</button>
                        <!-- <button type="button" class="font-medium text-red-600 dark:text-red-500 hover:underline" onclick="window.location='{{ route('student.destroy',$row->id) }}'">Hapus</button> -->
                    
                        <form action="{{ route('student.destroy',$row->id) }}" method="post">
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