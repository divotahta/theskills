<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Tambah Kelas') }}
        </h2>
    </x-slot>


<section>
    <form
        method="post"
        action="{{ route('kelas.store') }}"
        class="space-y-3"
        enctype="multipart/form-data"
    >
    @csrf
        <div class="space-y-2">
            <x-form.label
                for="name"
                :value="__('Nama Kelas')"
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
                :value="__('Jenis')"
            />
            <!-- <x-form.input
                id="type"
                name="type"
                class="block w-full"
                required
            /> -->
            <x-form.select id="type" name="type" class="block w-full" required>
                <option value="">-- Pilih Jenis --</option>
                <option value="math">Math</option>
                <option value="coding">Coding</option>
            </x-form.select>
            <x-form.error :messages="$errors->get('type')" />
        </div>
        <div class="space-y-2">
            <x-form.label
                :value="__('Harga')"
            />
            <x-form.input
                id="price"
                name="price"
                type="number"
                class="block w-full"
                required
            />
            <x-form.error :messages="$errors->get('price')" />
        </div>
        
        <div class="space-y-2">
            <x-form.label :value="__('Thumbnail')" />
            <input
                type="file"
                id="thumbnail_location"
                name="thumbnail_location"
                class="block w-full"
                accept="image/*"
                required
            />
            <x-form.error :messages="$errors->get('thumbnail_location')" />
        </div>


        <div class="flex items-center gap-4">
            <x-button>
                {{ __('Save') }}
            </x-button>
        </div>
    </form>
</section>

</x-app-layout>