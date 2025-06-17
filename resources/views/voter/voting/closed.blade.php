<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Voting Ditutup
        </h2>
    </x-slot>

    <div class="py-10 max-w-3xl mx-auto">
        <div class="bg-white p-6 rounded shadow text-center">
            <h3 class="text-lg font-bold text-red-600 mb-4">⚠️ Voting Ini Telah Ditutup</h3>
            <p class="text-gray-600">Voting <strong>{{ $election->title }}</strong> sudah tidak tersedia untuk voting.
            </p>
            @if(auth()->user()->has_voted)
                <div class="bg-blue-100 border border-blue-300 text-blue-800 px-4 py-3 mt-4 rounded">
                    Anda sudah memberikan suara. Terima kasih atas partisipasinya!
                    <a href="{{ route('voting.receipt', $vote->id) }}"
                        class="text-blue-500 hover:underline hover:text-blue-700">
                        Unduh Bukti Voting (PDF)
                    </a>
                </div>
            @endif
            <a href="{{ route('dashboard') }}" class="mt-4 inline-block text-blue-500 hover:underline">Kembali ke
                Dashboard</a>
        </div>
    </div>
</x-app-layout>