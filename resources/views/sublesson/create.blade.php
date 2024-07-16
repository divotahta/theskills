<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Tambah Sub Materi') }}
        </h2>
    </x-slot>


<section>
    <form
        method="post"
        action="{{ route('sublesson.store') }}"
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
    <x-form.label :value="__('Materi PDF')" />
    <input
        type="file"
        id="pdf_location"
        name="pdf_location"
        class="block w-full"
        accept="application/pdf"
    />
    <x-form.error :messages="$errors->get('pdf_location')" />
</div>
<div class="space-y-2">
            <x-form.label
                :value="__('Link Youtube Embed')"
            />
            <x-form.input
                id="youtube_link"
                name="youtube_link"
                class="block w-full"
                required
            />
            <x-form.error :messages="$errors->get('youtube_link')" />
        </div>
        
        <div class="space-y-2">
            <x-form.label
                :value="__('lesson')"
            />
            <x-form.select id="lesson" name="lesson" class="block w-full" required>
                <option value="">-- Pilih Materi --</option>
                @foreach ($lesson as $number => $row)
                <option value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
            </x-form.select>
            <x-form.error :messages="$errors->get('lesson')" />
        </div>


        <div class="flex items-center gap-4">
            <x-button>
                {{ __('Save') }}
            </x-button>
        </div>
    </form>
</section>

</x-app-layout>