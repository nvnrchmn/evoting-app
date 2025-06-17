<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Manajemen Grup Pengguna
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded shadow">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-800">Daftar Grup</h3>
                <a href="{{ route('admin.groups.create') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                    + Tambah Grup
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50 text-gray-600 text-left">
                        <tr>
                            <th class="px-4 py-2">Nama Grup</th>
                            <th class="px-4 py-2">Jumlah Anggota</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($groups as $group)
                            <tr>
                                <td class="px-4 py-2">{{ $group->name }}</td>
                                <td class="px-4 py-2">{{ $group->users->count() }} orang</td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="{{ route('admin.groups.edit', $group->id) }}"
                                        class="text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('admin.groups.destroy', $group->id) }}" method="POST"
                                        class="inline" onsubmit="return confirm('Yakin ingin menghapus grup ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-4 text-center text-gray-500">
                                    Belum ada grup yang tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>