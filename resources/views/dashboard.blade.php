<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Dashboard Voting
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto">
        <h2 class="text-2xl font-bold mb-4">Hasil Voting</h2>

        {{-- Tampilkan daftar kandidat dan suara --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            @foreach ($summary as $item)
                <div class="bg-white p-4 rounded shadow">
                    <h3 class="text-lg font-semibold">{{ $item['name'] }}</h3>
                    <p>Suara: <strong>{{ $item['votes'] }}</strong></p>
                    <p>Persentase: <strong>{{ $item['percentage'] }}%</strong></p>
                </div>
            @endforeach
        </div>

        {{-- Grafik batang --}}
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4">Grafik Persentase Suara</h3>
            <canvas id="voteChart" height="100"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('voteChart').getContext('2d');
        const voteChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Persentase Suara (%)',
                    data: @json($data),
                    backgroundColor: '#3b82f6',
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            callback: function (value) {
                                return value + '%';
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>