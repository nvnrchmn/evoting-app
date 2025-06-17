<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Daftar Pasangan Calon
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-700">Data Kandidat</h3>
                    <a href="{{ route('admin.candidates.create') }}"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-md transition">
                        + Tambah Kandidat
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-md overflow-hidden">
                        <thead class="bg-gray-100 text-left text-sm text-gray-700">
                            <tr>
                                <th class="p-3 border-b">Foto</th>
                                <th class="p-3 border-b">Ketua</th>
                                <th class="p-3 border-b">Wakil</th>
                                <th class="p-3 border-b">Visi & Misi</th>
                                <th class="p-3 border-b">Pemilihan</th>
                                <th class="p-3 border-b">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-800">
                            @forelse ($candidates as $candidate)
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="p-3">
                                        @if ($candidate->photo)
                                            <img src="{{ asset('storage/' . $candidate->photo) }}" alt="Foto Kandidat"
                                                class="w-20 h-20 object-cover rounded border">
                                        @else
                                            <span class="text-gray-400 italic">Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td class="p-3">
                                        {{ $candidate->persons->where('position', 'ketua')->first()->name ?? '-' }}
                                    </td>
                                    <td class="p-3">
                                        {{ $candidate->persons->where('position', 'wakil')->first()->name ?? '-' }}
                                    </td>
                                    <td class="p-3">
                                        <div>
                                            <strong>Visi:</strong> {{ $candidate->vision }}
                                        </div>
                                        <div class="mt-1">
                                            <strong>Misi:</strong> {{ $candidate->mission }}
                                        </div>
                                    </td>
                                    <td class="p-3">
                                        {{ $candidate->election->title ?? '-' }}
                                    </td>
                                    <td class="p-3">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('admin.candidates.edit', $candidate->id) }}"
                                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md transition">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.candidates.destroy', $candidate->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus kandidat ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-md transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center p-4 text-gray-500 italic">
                                        Belum ada kandidat terdaftar.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>