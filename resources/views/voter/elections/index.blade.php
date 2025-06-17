<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Voting yang Tersedia</h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto sm:px-6 lg:px-8">
        @forelse (auth()->user()->elections as $election)
            <div class="bg-white p-6 mb-4 rounded shadow">
                <h3 class="text-lg font-bold">
                    <a href="{{ route('voter.voting.index', ['election' => $election->id]) }}"
                        class="text-blue-600 hover:underline">
                        {{ $election->title }}
                    </a>
                </h3>
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

                <p class="text-sm text-gray-700">{{ $election->description }}</p>
            </div>
        @empty
            <p class="text-gray-600">Belum ada voting yang tersedia untuk Anda.</p>
        @endforelse
    </div>

</x-app-layout>