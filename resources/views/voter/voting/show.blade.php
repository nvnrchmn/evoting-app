<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pemilihan: {{ $election->title }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="mb-2"><strong>Deskripsi:</strong> {{ $election->description }}</p>
                <p class="mb-4"><strong>Periode:</strong> {{ $election->start_date }} s/d {{ $election->end_date }}</p>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if($hasVoted)
                    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4">
                        Anda sudah memberikan suara pada pemilihan ini.
                    </div>
                    <a href="{{ route('voter.voting.receipt', $vote->id) }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        📄 Unduh Bukti Voting
                    </a>
                @else
                    <form action="{{ route('voter.voting.vote') }}" method="POST">
                        @csrf
                        <input type="hidden" name="election_id" value="{{ $election->id }}">

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                            @foreach($election->candidates as $candidate)
                                <label for="candidate{{ $candidate->id }}" class="block cursor-pointer">
                                    <div class="bg-gray-100 border rounded-lg overflow-hidden hover:shadow-lg">
                                        @if($candidate->photo)
                                            <img src="{{ asset('storage/' . $candidate->photo) }}" alt="{{ $candidate->name }}"
                                                class="w-full h-48 object-cover">
                                        @endif
                                        <div class="p-4">
                                            <div class="flex items-center justify-between">
                                                <h3 class="text-lg font-bold">{{ $candidate->name }}</h3>
                                                <input type="radio" name="candidate_id" id="candidate{{ $candidate->id }}"
                                                    value="{{ $candidate->id }}" class="form-radio text-indigo-600" required>
                                            </div>
                                            <p class="text-sm text-gray-600 mt-2">{{ $candidate->description }}</p>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                🗳️ Kirim Suara
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>