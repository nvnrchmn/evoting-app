<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Manajemen Grup Pengguna
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded shadow">
            <!-- Header Atas -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4">
                <h3 class="text-lg font-bold text-gray-800">Daftar Grup</h3>
                <a href="{{ route('admin.groups.create') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm w-full md:w-auto text-center">
                    + Tambah Grup
                </a>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50 text-gray-600 text-left">
                        <tr>
                            <th class="px-4 py-2 whitespace-nowrap">Nama Grup</th>
                            <th class="px-4 py-2 whitespace-nowrap">Jumlah Anggota</th>
                            <th class="px-4 py-2 whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($groups as $group)
                            <tr>
                                <td class="px-4 py-2">{{ $group->name }}</td>
                                <td class="px-4 py-2">{{ $group->users->count() }} orang</td>
                                <td class="px-4 py-2">
                                    <div class="flex flex-wrap gap-2">
                                        <x-button type="button" variant="primary" class="min-w-[80px] text-center"
                                            onclick="window.location='{{ route('admin.groups.edit', $group->id) }}'">
                                            Edit
                                        </x-button>

                                        <form action="{{ route('admin.groups.destroy', $group->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus grup ini?')"
                                            class="inline-block">
                                            @csrf @method('DELETE')
                                            <x-button type="submit" variant="danger" class="min-w-[80px] text-center">
                                                Hapus
                                            </x-button>
                                        </form>
                                    </div>
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