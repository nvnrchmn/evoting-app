<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Voting</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Tombol Tambah Voting --}}
            <div class="mb-4">
                <a href="{{ route('admin.elections.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow inline-block text-sm">
                    + Tambah Voting
                </a>
            </div>

            {{-- Daftar Voting --}}
            @forelse ($elections as $election)
                <div class="bg-white p-4 md:p-6 mb-5 shadow rounded-md">
                    <div class="flex flex-col md:flex-row justify-between gap-4">
                        {{-- Informasi Voting --}}
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $election->title }}</h3>

                            {{-- Status --}}
                            <p class="text-sm text-gray-600 mt-1">
                                Status:
                                @if ($election->status === 'open')
                                    <span
                                        class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                        ✅ Open
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                        ❌ Closed
                                    </span>
                                @endif
                            </p>

                            {{-- Akses Grup --}}
                            <p class="text-sm text-gray-600 mt-1">
                                Akses untuk grup:
                                <strong>{{ $election->groups->pluck('name')->join(', ') ?: 'Tidak ada' }}</strong>
                            </p>

                            {{-- Jumlah Pengguna --}}
                            <p class="text-sm text-gray-600 mt-1">
                                Pengguna:
                                @php
                                    $userCount = $election->groups->flatMap->users->unique('id')->count();
                                @endphp
                                @if ($userCount === 0)
                                    <span class="text-red-500">Tidak ada</span>
                                @else
                                    {{ $userCount }} pengguna dari grup: {{ $election->groups->pluck('name')->join(', ') }}
                                @endif
                            </p>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex md:flex-col justify-end items-start md:items-end gap-2">
                            <x-button-link href="{{ route('admin.elections.edit', $election->id) }}"
                                class="w-full md:w-auto">
                                ✏️ Edit
                            </x-button-link>

                            <form action="{{ route('admin.elections.destroy', $election->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus?')" class="w-full md:w-auto">
                                @csrf @method('DELETE')
                                <x-button type="submit" variant="danger" class="w-full md:w-auto">
                                    🗑️ Hapus
                                </x-button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white p-6 rounded shadow text-gray-600 text-center">
                    Belum ada voting yang dibuat.
                </div>
            @endforelse

        </div>
    </div>
</x-app-layout>