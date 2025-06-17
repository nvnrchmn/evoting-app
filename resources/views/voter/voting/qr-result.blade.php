<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Detail Suara Pemilih
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
            <p><strong>Nama Voting:</strong> {{ $election->title }}</p>
            <p><strong>Kandidat Terpilih:</strong>
                {{ $candidate->persons->where('position', 'ketua')->first()->name ?? 'Tidak ditemukan' }} &
                {{ $candidate->persons->where('position', 'wakil')->first()->name ?? 'Tidak ditemukan' }}
            </p>
            <p><strong>Waktu Voting:</strong> {{ $vote->created_at->timezone('Asia/Jakarta')->format('d-m-Y H:i:s') }}
            </p>
        </div>
    </div>
</x-app-layout>