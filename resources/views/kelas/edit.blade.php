<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Edit Data Kelas') }}
        </h2>
    </x-slot>


<section>
    <form
        method="post"
        action="{{ route('kelas.update', $kelas->id) }}"
        class="space-y-3"
        enctype="multipart/form-data"
    >
    @csrf
    @method('put')
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
                :value="old('name', $kelas->name)"
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
                :value="old('description', $kelas->description)"
                class="block w-full"
                required
            />
            <x-form.error :messages="$errors->get('description')" />
        </div>
        <div class="space-y-2">
            <x-form.label :value="__('Jenis')" />
            <x-form.select id="type" name="type" class="block w-full" required>
                <option value="math" {{ $kelas->type == 'math' ? 'selected' : '' }}>Math</option>
                <option value="coding" {{ $kelas->type == 'coding' ? 'selected' : '' }}>Coding</option>
            </x-form.select>

            <x-form.error :messages="$errors->get('grade')" />
        </div>

        <div class="space-y-2">
            <x-form.label
                :value="__('Harga')"
            />
            <x-form.input
                id="price"
                name="price"
                type="number"
                :value="old('price', $kelas->price)"
                class="block w-full"
                required
            />
            <x-form.error :messages="$errors->get('price')" />
        </div>

        <div class="space-y-2">
            <x-form.label :value="__('Thumbnail')" />

            @if ($kelas->thumbnail_location)
                <img src="{{ asset('storage/' . $kelas->thumbnail_location) }}" alt="Current Thumbnail" width="500" class="mb-2">
            @endif

            <x-form.input
                id="thumbnail_location"
                name="thumbnail_location"
                type="file"
                class="block w-full"
                accept="image/*"
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