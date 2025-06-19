<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Kandidat</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <form method="POST" action="{{ route('admin.candidates.update', $candidate->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Pemilihan --}}
                    <div class="mb-4">
                        <label for="election_id" class="block font-medium text-sm text-gray-700">Pemilihan</label>
                        <select name="election_id" id="election_id"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @foreach ($elections as $election)
                                <option value="{{ $election->id }}" {{ $candidate->election_id == $election->id ? 'selected' : '' }}>
                                    {{ $election->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Visi --}}
                    <div class="mb-4">
                        <label for="vision" class="block font-medium text-sm text-gray-700">Visi</label>
                        <textarea name="vision" id="vision" rows="3"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('vision', $candidate->vision) }}</textarea>
                    </div>

                    {{-- Misi --}}
                    <div class="mb-4">
                        <label for="mission" class="block font-medium text-sm text-gray-700">Misi</label>
                        <textarea name="mission" id="mission" rows="3"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('mission', $candidate->mission) }}</textarea>
                    </div>

                    {{-- Foto --}}
                    <div class="mb-4">
                        <label for="photo" class="block font-medium text-sm text-gray-700">Foto (Opsional)</label>
                        <input type="file" name="photo" id="photo" class="mt-1 block w-full text-sm text-gray-600">
                        @if ($candidate->photo)
                            <img src="{{ asset('storage/' . $candidate->photo) }}" class="mt-2 h-20 border rounded"
                                alt="Foto Kandidat">
                        @endif
                    </div>

                    {{-- Tombol --}}
                    <div class="flex items-center gap-3">
                        <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Simpan
                            Perubahan</button>
                        <a href="{{ route('admin.candidates.index') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>