<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Edit Grup: {{ $group->name }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded shadow">

            {{-- Flash Message --}}
            @if(session('success'))
                <div class="mb-4 text-green-700 bg-green-100 p-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Edit Nama Grup --}}
            <form action="{{ route('admin.groups.update', $group->id) }}" method="POST" class="mb-6">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block font-medium text-sm text-gray-700">Nama Grup</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full rounded border-gray-300 shadow-sm"
                        value="{{ old('name', $group->name) }}" required>
                </div>

                <x-primary-button>Update Grup</x-primary-button>
            </form>

            <hr class="my-6">

            {{-- Kelola Anggota Grup --}}
            <h3 class="text-lg font-semibold mb-4">Anggota Grup</h3>

            <form method="POST" action="{{ route('admin.groups.update', $group->id) }}">
                @csrf
                @method('PUT')

                <label for="name">Nama Group</label>
                <input type="text" name="name" value="{{ $group->name }}">

                <h3 class="mt-4">Pilih Anggota:</h3>
                @foreach($users as $user)
                    <div>
                        <label>
                            <input type="checkbox" name="members[]" value="{{ $user->id }}" {{ in_array($user->id, $members) ? 'checked' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </label>
                    </div>
                @endforeach

                <button type="submit"
                    class="mt-4 bg-blue-500 text-sm text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
                <a href="{{ route('admin.groups.index') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
            </form>

        </div>
    </div>
</x-app-layout>