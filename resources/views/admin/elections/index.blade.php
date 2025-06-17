<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Voting</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('admin.elections.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">+ Tambah Voting</a>

        @foreach ($elections as $election)
            <div class="bg-white p-4 mb-4 shadow rounded">
                <h3 class="text-lg font-bold">{{ $election->title }}
                    {{-- <span class="text-sm text-gray-500">({{ $election->status }})</span> --}}
                    <p class="text-sm text-gray-600 mb-2">
                        Status:
                        @if ($election->status === 'open')
                            <span
                                class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                ✅ Open
                            </span>
                        @else
                            <span
                                class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                ❌ Closed
                            </span>
                        @endif
                    </p>
                </h3>
                <p class="mt-2 text-sm text-gray-600">
                    Akses diberikan kepada grup:
                    {{ $election->groups->pluck('name')->join(', ') ?: 'Tidak ada' }}
                </p>
                <p class="text-sm text-gray-600 mt-1">
                    Akses diberikan kepada {{ $election->groups->flatMap->users->unique('id')->count() }} pengguna dari
                    grup:
                    @if($election->groups->flatMap->users->isEmpty())
                        <span class="text-red-500">Tidak ada</span>
                    @else
                        {{ $election->groups->pluck('name')->join(', ') }}
                    @endif
                </p>


                <div class="mt-3">
                    <a href="{{ route('admin.elections.edit', $election->id) }}"
                        class="text-blue-600 hover:underline ml-1 text-xs font-semibold rounded px-2 py-1 bg-blue-100 text-blue-800">Edit</a>
                    <form action="{{ route('admin.elections.destroy', $election->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Yakin ingin menghapus?')"
                            class="text-red-600 hover:underline ml-1 text-xs font-semibold rounded px-2 py-1 bg-red-100 text-red-800">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>