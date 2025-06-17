<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Voting: {{ $election->title }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @if(auth()->user()->has_voted)
                <div
                    class="bg-blue-100 border border-blue-300 text-blue-800 px-4 py-3 rounded flex items-center justify-between">
                    <span>Anda sudah memberikan suara. Terima kasih atas partisipasinya!</span>
                    @isset($vote)
                        <a href="{{ route('voting.receipt', $vote->id) }}"
                            class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded ml-4">
                            Unduh Bukti Voting (PDF)
                        </a>
                    @endisset
                </div>

            @elseif($election && $candidates->count())
                <form action="{{ route('voter.voting.vote') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($candidates as $candidate)
                            <div class="border p-4 rounded shadow bg-white">
                                @if($candidate->photo)
                                    <img src="{{ asset('storage/' . $candidate->photo) }}" alt="Foto Pasangan"
                                        class="mb-4 w-full h-60 object-cover rounded">
                                @endif

                                <p class="mb-2"><strong>Visi:</strong> {{ $candidate->vision }}</p>
                                <p class="mb-2"><strong>Misi:</strong> {{ $candidate->mission }}</p>

                                <ul class="mb-4 text-sm text-gray-700">
                                    @foreach($candidate->persons as $person)
                                        <li><strong>{{ ucfirst($person->position) }}:</strong> {{ $person->name }}</li>
                                    @endforeach
                                </ul>

                                <button type="submit" name="candidate_id" value="{{ $candidate->id }}"
                                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">
                                    Pilih Pasangan Ini
                                </button>
                            </div>
                        @endforeach
                    </div>
                </form>
            @else
                <p class="text-gray-600">Belum ada kandidat tersedia atau voting belum dibuka.</p>
            @endif

        </div>
    </div>
</x-app-layout>