<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Kandidat</h2>
    </x-slot>

    <div class="py-6">
        <x-container>
            <x-button-link href="{{ route('admin.candidates.create') }}" class="mb-4">+ Tambah Kandidat</x-button-link>

            <x-table>
                <x-slot name="head">
                    <x-table.th>Pasangan</x-table.th>
                    <x-table.th>Visi</x-table.th>
                    <x-table.th>Misi</x-table.th>
                    <x-table.th>Election</x-table.th>
                    <x-table.th>Aksi</x-table.th>
                </x-slot>

                <x-slot name="body">
                    @foreach ($candidates as $candidate)
                        <x-table.tr>
                            {{-- <x-table.td>
                                @foreach ($candidate->persons as $person)
                                <div>
                                    <strong>{{ ucfirst($person->position ?? 'no position') }}:</strong>
                                    {{ $person->name ?? 'no name' }}
                                </div>
                                @endforeach
                            </x-table.td> --}}
                            <x-table.td>
                                @foreach ($candidate->persons as $person)
                                    <div><strong>{{ ucfirst($person->position) }}:</strong> {{ $person->name }}</div>
                                @endforeach
                            </x-table.td>
                            <x-table.td>{{ $candidate->vision }}</x-table.td>
                            <x-table.td>{{ $candidate->mission }}</x-table.td>
                            <x-table.td>{{ $candidate->election->title }}</x-table.td>
                            <x-table.td>
                                <x-button href="{{ route('admin.candidates.edit', $candidate->id) }}"
                                    class="mb-1">Edit</x-button>
                                <form action="{{ route('admin.candidates.destroy', $candidate->id) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf @method('DELETE')
                                    <x-button type="submit" variant="danger">Hapus</x-button>
                                </form>
                            </x-table.td>
                        </x-table.tr>
                    @endforeach
                </x-slot>
            </x-table>
        </x-container>
    </div>
</x-app-layout>