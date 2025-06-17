<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Grup: {{ $group->name }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Grup</h3>

            <p class="text-sm text-gray-600 mb-2">
                <strong>Nama Grup:</strong> {{ $group->name }}
            </p>

            <h4 class="text-md font-semibold text-gray-700 mt-6 mb-2">Anggota Grup</h4>
            @if ($group->users->isEmpty())
                <p class="text-sm text-gray-500">Belum ada anggota dalam grup ini.</p>
            @else
                <ul class="list-disc list-inside text-sm text-gray-700 space-y-1">
                    @foreach ($group->users as $user)
                        <li>{{ $user->name }} ({{ $user->email }})</li>
                    @endforeach
                </ul>
            @endif

            <div class="mt-6">
                <a href="{{ route('admin.groups.index') }}"
                    class="inline-block px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                    Kembali ke Daftar Grup
                </a>
            </div>
        </div>
    </div>
</x-app-layout>