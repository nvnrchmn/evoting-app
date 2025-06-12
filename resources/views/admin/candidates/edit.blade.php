<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Kandidat
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.candidates.update', $candidate->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Pemilihan --}}
                    <div class="mb-4">
                        <label for="election_id" class="block font-medium text-sm text-gray-700">Pemilihan</label>
                        <select name="election_id" id="election_id"
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            @foreach($elections as $election)
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
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">{{ old('vision', $candidate->vision) }}</textarea>
                    </div>

                    {{-- Misi --}}
                    <div class="mb-4">
                        <label for="mission" class="block font-medium text-sm text-gray-700">Misi</label>
                        <textarea name="mission" id="mission" rows="3"
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">{{ old('mission', $candidate->mission) }}</textarea>
                    </div>

                    {{-- Foto Pasangan Kandidat --}}
                    <div class="mb-6">
                        <label for="photo" class="block font-medium text-sm text-gray-700">Foto Pasangan
                            (Opsional)</label>
                        @if($candidate->photo)
                            <img src="{{ asset('storage/' . $candidate->photo) }}" class="h-24 mb-2 rounded shadow">
                        @endif
                        <input type="file" name="photo" id="photo"
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <hr class="my-6">

                    {{-- Ketua --}}
                    <h3 class="text-lg font-semibold mb-2">Ketua</h3>

                    <div class="mb-4">
                        <label for="leader_name" class="block font-medium text-sm text-gray-700">Nama Ketua</label>
                        <input id="leader_name" name="leader_name" type="text"
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                            value="{{ old('leader_name', $leader->name ?? '') }}">
                    </div>

                    <div class="mb-6">
                        <label for="leader_photo" class="block font-medium text-sm text-gray-700">Foto Ketua
                            (Opsional)</label>
                        @if($leader?->photo)
                            <img src="{{ asset('storage/' . $leader->photo) }}" class="h-24 mb-2 rounded shadow">
                        @endif
                        <input type="file" name="leader_photo" id="leader_photo"
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <hr class="my-6">

                    {{-- Wakil --}}
                    <h3 class="text-lg font-semibold mb-2">Wakil</h3>

                    <div class="mb-4">
                        <label for="deputy_name" class="block font-medium text-sm text-gray-700">Nama Wakil</label>
                        <input id="deputy_name" name="deputy_name" type="text"
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                            value="{{ old('deputy_name', $deputy->name ?? '') }}">
                    </div>

                    <div class="mb-6">
                        <label for="deputy_photo" class="block font-medium text-sm text-gray-700">Foto Wakil
                            (Opsional)</label>
                        @if($deputy?->photo)
                            <img src="{{ asset('storage/' . $deputy->photo) }}" class="h-24 mb-2 rounded shadow">
                        @endif
                        <input type="file" name="deputy_photo" id="deputy_photo"
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="mt-6">
                        <x-primary-button>
                            Update Kandidat
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>