<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Pasangan Kandidat</h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6 space-y-6">

                {{-- Error Alert --}}
                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-4 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.candidates.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

                    {{-- Voting Selector --}}
                    <div>
                        <label for="election_id" class="block font-medium text-gray-700 mb-1">Pilih Voting</label>
                        <select name="election_id" id="election_id" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                            <option value="">-- Pilih --</option>
                            @foreach ($elections as $election)
                                <option value="{{ $election->id }}" {{ old('election_id') == $election->id ? 'selected' : '' }}>
                                    {{ $election->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Foto Pasangan --}}
                    <div>
                        <label for="photo" class="block font-medium text-gray-700 mb-1">Foto Pasangan (Opsional)</label>
                        <input type="file" name="photo" id="photo" accept="image/*"
                            class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    {{-- Visi & Misi --}}
                    <div>
                        <label for="vision" class="block font-medium text-gray-700 mb-1">Visi</label>
                        <textarea name="vision" id="vision" rows="3"
                            class="w-full border-gray-300 rounded-md shadow-sm">{{ old('vision') }}</textarea>
                    </div>
                    <div>
                        <label for="mission" class="block font-medium text-gray-700 mb-1">Misi</label>
                        <textarea name="mission" id="mission" rows="3"
                            class="w-full border-gray-300 rounded-md shadow-sm">{{ old('mission') }}</textarea>
                    </div>

                    <hr class="my-6">

                    {{-- Ketua --}}
                    <h3 class="text-lg font-bold text-gray-800">Data Ketua</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="leader_name" class="block font-medium text-gray-700 mb-1">Nama Ketua</label>
                            <input type="text" name="leader_name" id="leader_name" value="{{ old('leader_name') }}"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label for="leader_photo" class="block font-medium text-gray-700 mb-1">Foto Ketua
                                (Opsional)</label>
                            <input type="file" name="leader_photo" id="leader_photo" accept="image/*"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>

                    {{-- Wakil --}}
                    <h3 class="text-lg font-bold text-gray-800 mt-6">Data Wakil</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="deputy_name" class="block font-medium text-gray-700 mb-1">Nama Wakil</label>
                            <input type="text" name="deputy_name" id="deputy_name" value="{{ old('deputy_name') }}"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label for="deputy_photo" class="block font-medium text-gray-700 mb-1">Foto Wakil
                                (Opsional)</label>
                            <input type="file" name="deputy_photo" id="deputy_photo" accept="image/*"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-6">
                        <x-button variant="primary" class="w-full sm:w-auto text-center">
                            Simpan Kandidat
                            </x-primary-button>

                            <a href="{{ route('admin.candidates.index') }}"
                                class="text-sm text-gray-600 hover:underline text-center">
                                Batal & Kembali
                            </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>