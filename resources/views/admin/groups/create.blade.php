<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Tambah Grup Baru
        </h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded shadow">
            @if($errors->any())
                <div class="mb-4 text-red-700 bg-red-100 p-3 rounded">
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.groups.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Grup</label>
                    <input type="text" name="name" id="name" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('name') }}">
                </div>

                <div class="flex justify-end space-x-2">
                    <a href="{{ route('admin.groups.index') }}"
                        class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>