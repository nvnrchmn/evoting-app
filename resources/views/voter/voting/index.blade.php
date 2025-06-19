<x-app-layout>
    <x-slot name="header">Daftar Voting</x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse ($elections as $election)
            <div class="bg-white shadow-md p-4 rounded">
                <h2 class="font-bold text-xl">{{ $election->title }}</h2>
                <p>{{ $election->description }}</p>
                <a href="{{ route('voter.voting.show', $election->id) }}" class="text-blue-500">Lihat Detail</a>
            </div>
        @empty
            <p>Tidak ada pemilu yang tersedia untuk Anda.</p>
        @endforelse
    </div>
</x-app-layout>