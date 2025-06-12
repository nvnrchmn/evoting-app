<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Pasangan Kandidat
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.candidates.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

                    {{-- Pilih Pemilu --}}
                    <div>
                        <label for="election_id" :value="'Pilih Pemilu'" />
                        <select name="election_id" id="election_id" class="w-full border rounded px-3 py-2">
                            <option value="">-- Pilih --</option>
                            @foreach ($elections as $election)
                                <option value="{{ $election->id }}" {{ old('election_id') == $election->id ? 'selected' : '' }}>
                                    {{ $election->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Foto pasangan --}}
                    <div>
                        <label for="photo" :value="'Foto Pasangan (Opsional)'" />
                        <input type="file" name="photo" id="photo" accept="image/*"
                            class="w-full border rounded px-3 py-2">
                    </div>

                    {{-- Visi & Misi --}}
                    <div>
                        <h3 class="text-xl font-bold">Visi</h3>
                        <label for="vision" :value="'Visi'" />
                        <textarea name="vision" id="vision" rows="3"
                            class="w-full border rounded px-3 py-2">{{ old('vision') }}</textarea>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold">Misi</h3>
                        <label for="mission" :value="'Misi'" />
                        <textarea name="mission" id="mission" rows="3"
                            class="w-full border rounded px-3 py-2">{{ old('mission') }}</textarea>
                    </div>

                    <hr class="my-4">

                    {{-- Ketua --}}
                    <h3 class="text-xl font-bold">Data Ketua</h3>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label for="leader_name" :value="'Nama Ketua'" />
                            <input id="leader_name" class="block mt-1 w-full" type="text" name="leader_name"
                                value="{{ old('leader_name') }}" />
                        </div>
                        <div>
                            <label for="leader_photo" :value="'Foto Ketua (Opsional)'" />
                            <input type="file" name="leader_photo" id="leader_photo" accept="image/*"
                                class="w-full border rounded px-3 py-2">
                        </div>
                    </div>

                    {{-- Wakil --}}
                    <h3 class="text-xl font-bold mt-6">Data Wakil</h3>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label for="deputy_name" :value="'Nama Wakil'" />
                            <input id="deputy_name" class="block mt-1 w-full" type="text" name="deputy_name"
                                value="{{ old('deputy_name') }}" />
                        </div>
                        <div>
                            <label for="deputy_photo" :value="'Foto Wakil (Opsional)'" />
                            <input type="file" name="deputy_photo" id="deputy_photo" accept="image/*"
                                class="w-full border rounded px-3 py-2">
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="mt-6">
                        <x-primary-button>
                            Simpan Kandidat
                        </x-primary-button>
                        <a href="{{ route('admin.candidates.index') }}"
                            class="ml-4 text-gray-600 hover:underline">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>