<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Verifikasi Bukti Voting
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-md p-6 space-y-6">
                <div class="text-center">
                    <h3 class="text-xl font-bold text-green-700">✅ Bukti Voting Ditemukan</h3>
                    <p class="text-sm text-gray-500 mt-1">Data ini diverifikasi langsung dari sistem E-Voting.</p>
                </div>

                <div class="border-t pt-4 grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm text-gray-700">
                    <div>
                        <p class="font-medium text-gray-600">Nama Pemilih:</p>
                        <p>{{ $user->name }}</p>
                        <p class="mt-2 font-medium text-gray-600">Email:</p>
                        <p>{{ $user->email }}</p>
                    </div>

                    <div>
                        <p class="font-medium text-gray-600">Waktu Voting:</p>
                        <p>{{ $vote->created_at->timezone('Asia/Jakarta')->format('d-m-Y H:i:s') }}</p>
                        <p class="mt-2 font-medium text-gray-600">Voting:</p>
                        <p>{{ $election->title }}</p>
                    </div>
                </div>

                <div class="pt-4 border-t">
                    <p class="font-medium text-gray-700 mb-2">Kandidat yang Dipilih:</p>
                    <ul class="list-disc list-inside text-sm text-gray-800">
                        @foreach($candidate->persons as $person)
                            <li>{{ ucfirst($person->position) }}: {{ $person->name }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="pt-4 text-center text-xs text-gray-400 border-t">
                    Dicetak dan diverifikasi otomatis oleh sistem e-voting. Terima kasih atas partisipasi Anda.
                </div>
            </div>
        </div>
    </div>
</x-app-layout>