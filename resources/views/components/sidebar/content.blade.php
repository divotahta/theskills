<x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="flex flex-col flex-1 gap-4 px-3"
>

@if(Auth::user()->role == 'admin')
    <x-sidebar.link
        title="Beranda"
        href="{{ route('beranda') }}"
        :isActive="request()->routeIs('beranda')"
    >
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    <x-sidebar.link
        title="Siswa"
        href="{{ route('student.index') }}"
        :isActive="request()->routeIs('student.index')"
    >
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    <x-sidebar.link
        title="Kelas"
        href="{{ route('kelas.index') }}"
        :isActive="request()->routeIs('kelas.index')"
    >
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    <x-sidebar.link
        title="Materi"
        href="{{ route('lesson.index') }}"
        :isActive="request()->routeIs('lesson.index')"
    >
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    <x-sidebar.link
        title="Sub Materi"
        href="{{ route('sublesson.index') }}"
        :isActive="request()->routeIs('sublesson.index')"
    >
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    @endif

    @if(Auth::user()->role == 'student')
    <x-sidebar.link
        title="Beranda"
        href="{{ route('panel-siswa.dashboard') }}"
        :isActive="request()->routeIs('panel-siswa.dashboard')"
    >
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    <x-sidebar.link
        title="Kelas Math"
        href="{{ route('panel-siswa.daftarKelasMath') }}"
        :isActive="request()->routeIs('panel-siswa.daftarKelasMath')"
    >
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    <x-sidebar.link
        title="Kelas Coding"
        href="{{ route('panel-siswa.daftarKelasCoding') }}"
        :isActive="request()->routeIs('panel-siswa.daftarKelasCoding')"
    >
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    @endif

    <!-- <x-sidebar.dropdown
        title="Materi"
        :active="Str::startsWith(request()->route()->uri(), 'gandrungan.edit')"
    >
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <x-sidebar.sublink
            title="Tambah Materi"
            href=""
            :active="request()->routeIs('gandrungan.edit')"
        />
        <x-sidebar.sublink
            title="Lihat Materi"
            href=""
            :active="request()->routeIs('gandrungan.edit')"
        />
    </x-sidebar.dropdown>

    <x-sidebar.dropdown
        title="Siswa"
        :active="Str::startsWith(request()->route()->uri(), 'gandrungan.edit')"
    >
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <x-sidebar.sublink
            title="Tambah Siswa"
            href=""
            :active="request()->routeIs('gandrungan.edit')"
        />
        <x-sidebar.sublink
            title="Lihat Siswa"
            href=""
            :active="request()->routeIs('gandrungan.edit')"
        />
    </x-sidebar.dropdown>


    <x-sidebar.dropdown
        title="Kelas"
        :active="Str::startsWith(request()->route()->uri(), 'gandrungan.edit')"
    >
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <x-sidebar.sublink
            title="Tambah Kelas"
            href=""
            :active="request()->routeIs('gandrungan.edit')"
        />
        <x-sidebar.sublink
            title="Lihat Kelas"
            href=""
            :active="request()->routeIs('gandrungan.edit')"
        />
    </x-sidebar.dropdown> -->


    
   

</x-perfect-scrollbar>
