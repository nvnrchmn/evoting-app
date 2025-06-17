<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <h2 class="text-xl font-semibold text-gray-800 leading-tight">
                Dashboard Voting
            </h2>

            <form action="{{ route('dashboard') }}" method="GET">
                <select name="election_id" onchange="this.form.submit()"
                    class="block w-full border-gray-300 rounded-md shadow-sm">
                    @foreach($elections as $election)
                        <option value="{{ $election->id }}" {{ $selectedElection && $selectedElection->id == $election->id ? 'selected' : '' }}>
                            {{ $election->title }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        @if($selectedElection)
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Hasil Voting</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse ($summary as $item)
                        <div class="bg-white p-5 rounded-lg shadow">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $item['name'] }}</h3>
                            <p class="text-sm text-gray-600 mt-1">Suara: <strong>{{ $item['voteCount'] }}</strong></p>
                            <p class="text-sm text-gray-600">Persentase: <strong>{{ $item['percentage'] }}%</strong></p>
                        </div>
                    @empty
                        <p class="text-gray-500">Belum ada kandidat.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Grafik Persentase Suara</h3>
                <canvas id="voteChart" height="100"></canvas>
            </div>
        @else
            <p class="text-gray-600">Tidak ada voting aktif yang tersedia saat ini.</p>
        @endif
    </div>

    @if($selectedElection)
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
                        borderRadius: 6,
                        barPercentage: 0.6,
                        categoryPercentage: 0.5
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return context.parsed.y + '%';
                                }
                            }
                        }
                    },
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
    @endif
</x-app-layout>