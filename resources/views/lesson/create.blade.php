<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Tambah Materi') }}
        </h2>
    </x-slot>


<section>
    <form
        method="post"
        action="{{ route('lesson.store') }}"
        class="space-y-3"
        enctype="multipart/form-data"
    >
    @csrf
        <div class="space-y-2">
            <x-form.label
                for="name"
                :value="__('Judul')"
            />
            <x-form.input
                id="name"
                name="name"
                type="text"
                class="block w-full"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
            />
            <x-form.error :messages="$errors->get('name')" />
        </div>

        <div class="space-y-2">
            <x-form.label
                :value="__('Deskripsi')"
            />
            <x-form.input
                id="description"
                name="description"
                class="block w-full"
                required
            />
            <x-form.error :messages="$errors->get('description')" />
        </div>
        <div class="space-y-2">
            <x-form.label
                :value="__('Kelas')"
            />
            <!-- <x-form.input
                id="type"
                name="type"
                class="block w-full"
                required
            /> -->
            <x-form.select id="kelas" name="kelas" class="block w-full" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach ($kelas as $number => $row)
                <option value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
            </x-form.select>
            <x-form.error :messages="$errors->get('kelas')" />
        </div>


        <div class="flex items-center gap-4">
            <x-button>
                {{ __('Save') }}
            </x-button>
        </div>
    </form>
</section>

</x-app-layout>