<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Voting</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <form action="{{ route('admin.elections.store') }}" method="POST" class="bg-white p-6 shadow rounded">
            @csrf

            {{-- Judul --}}
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Judul Voting</label>
                <input type="text" name="title" id="title" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-200">
            </div>

            {{-- Deskripsi --}}
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" id="description" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-200"></textarea>
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-200">
                    <option value="open">Open</option>
                    <option value="closed">Closed</option>
                </select>
            </div>

            {{-- Akses Group Voter --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Akses untuk Group Voter</label>
                <div class="space-y-2">
                    @forelse ($groups as $group)
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="groups[]" value="{{ $group->id }}" class="rounded text-blue-600"
                                {{ in_array($group->id, $selectedGroups ?? []) ? 'checked' : '' }}>
                            <span class="ml-2">{{ $group->name }}</span>
                        </label>
                    @empty
                        <p class="text-sm text-gray-500 italic">Belum ada grup tersedia.</p>
                    @endforelse
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="mt-6 flex items-center">
                <x-primary-button>Simpan</x-primary-button>
                <a href="{{ route('admin.elections.index') }}"
                    class="ml-4 text-sm text-gray-600 hover:underline">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
