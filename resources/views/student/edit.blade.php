<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Edit Data Siswa') }}
        </h2>
    </x-slot>


<section>
    <form
        method="post"
        action="{{ route('student.update', $student->id) }}"
        class="space-y-3"
    >
    @csrf
    @method('put')
        <div class="space-y-2">
            <x-form.label
                for="name"
                :value="__('Nama Lengkap')"
            />
            <x-form.input
                id="name"
                name="name"
                type="text"
                class="block w-full"
                :value="old('name', $student->name)"
                required
                autofocus
                autocomplete="name"
            />
            <x-form.error :messages="$errors->get('name')" />
        </div>

        <div class="space-y-2">
            <x-form.label
                for="name"
                :value="__('Course')"
            />
        <x-form.select id="kelas_id" name="kelas_id[]" class="block w-full" multiple>
            @foreach ($kelas as $number => $row)
                <option value="{{ $row->id }}" {{ in_array($row->id, $kelasTerpilih) ? 'selected' : '' }}>{{ $row->name }}</option>
            @endforeach
        </x-form.select>
        </div>

        <div class="space-y-2">
            <x-form.label 
                :value="__('Tanggal Lahir')" 
            />
            <x-form.input
                type="number"
                id="birth"
                name="birth"
                :value="old('birth', $student->birth)"
                class="block w-full"
                required
                min=1990
                max=2023
            />
            <x-form.error :messages="$errors->get('birth')" />
        </div>

        <div class="space-y-2">
            <x-form.label
                :value="__('Nama Sekolah')"
            />
            <x-form.input
                id="school_name"
                name="school_name"
                class="block w-full"
                :value="old('school_name', $student->school_name)"
                required
            />
            <x-form.error :messages="$errors->get('school_name')" />
        </div>
        <div class="space-y-2">
            <x-form.label :value="__('Kelas')" />
            <x-form.input
                type="number"
                id="grade"
                name="grade"
                :value="old('grade', $student->grade)"
                class="block w-full"
                required
            />
            <x-form.error :messages="$errors->get('grade')" />
        </div>

        <div class="space-y-2">
            <x-form.label
                :value="__('Asal Kota')"
            />
            <x-form.input
                id="addres"
                name="addres"
                :value="old('addres', $student->addres)"
                class="block w-full"
                required
            />
            <x-form.error :messages="$errors->get('addres')" />
        </div>
        <div class="space-y-2">
            <x-form.label
                for="email"
                :value="__('Email')"
            />
            <x-form.input
                id="email"
                name="email"
                type="email"
                :value="old('email', $student->email)"
                class="block w-full"
                required
                autocomplete="email"
            />
            <x-form.error :messages="$errors->get('email')" />
        </div>
        <div class="space-y-2">
            <x-form.label :value="__('No Telepon')" />
            <x-form.input
                type="number"
                id="phone"
                name="phone"
                :value="old('phone', $student->phone)"
                class="block w-full"
                required
            />
            <x-form.error :messages="$errors->get('phone')" />
        </div>


        <div class="flex items-center gap-4">
            <x-button>
                {{ __('Save') }}
            </x-button>
        </div>
    </form>
</section>

</x-app-layout>