<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-navy-900 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <p class="text-ink-600 text-sm">Welcome, {{ auth()->user()->name }}.</p>

            {{-- Compact stat strip --}}
            <div
                class="grid grid-cols-2 md:grid-cols-4 gap-px bg-gray-200 border border-gray-200 sm:rounded-md overflow-hidden">
                <div class="bg-white p-4">
                    <p class="text-xs text-ink-600 uppercase tracking-wide">Total Requests</p>
                    <p class="text-2xl font-bold text-navy-900 mt-1">{{ $stats['total_requests'] }}</p>
                </div>
                <div class="bg-white p-4">
                    <p class="text-xs text-ink-600 uppercase tracking-wide">Officers</p>
                    <p class="text-2xl font-bold text-navy-900 mt-1">{{ $stats['total_officers'] }}</p>
                </div>
                <div class="bg-white p-4">
                    <p class="text-xs text-ink-600 uppercase tracking-wide">Ward Offices</p>
                    <p class="text-2xl font-bold text-navy-900 mt-1">{{ $stats['total_ward_offices'] }}</p>
                </div>
                <div class="bg-white p-4">
                    <p class="text-xs text-ink-600 uppercase tracking-wide">Approval Rate</p>
                    <p class="text-2xl font-bold text-govgreen-800 mt-1">
                        @php
                            $decided = $stats['approved'] + $stats['rejected'];
                            $rate = $decided > 0 ? round(($stats['approved'] / $decided) * 100) : 0;
                        @endphp
                        {{ $rate }}%
                    </p>
                </div>
            </div>

            {{-- Charts grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Status distribution --}}
                <div class="bg-white border border-gray-200 sm:rounded-md p-6">
                    <h3 class="font-semibold text-navy-900 mb-4 pb-2 border-b border-gray-200">Status Distribution</h3>
                    <canvas id="statusChart" height="220"></canvas>
                </div>

                {{-- Requests by document type --}}
                <div class="bg-white border border-gray-200 sm:rounded-md p-6">
                    <h3 class="font-semibold text-navy-900 mb-4 pb-2 border-b border-gray-200">By Document Type</h3>
                    <canvas id="typeChart" height="220"></canvas>
                </div>

                {{-- Requests by ward --}}
                <div class="bg-white border border-gray-200 sm:rounded-md p-6">
                    <h3 class="font-semibold text-navy-900 mb-4 pb-2 border-b border-gray-200">By Ward Office</h3>
                    <canvas id="wardChart" height="220"></canvas>
                </div>
            </div>

            {{-- Trend over time --}}
            <div class="bg-white border border-gray-200 sm:rounded-md p-6">
                <h3 class="font-semibold text-navy-900 mb-4 pb-2 border-b border-gray-200">Requests — Last 30 Days</h3>
                <canvas id="trendChart" height="90"></canvas>
            </div>

            {{-- Quick links --}}
            <div class="bg-white border border-gray-200 sm:rounded-md p-6">
                <h3 class="font-semibold text-navy-900 mb-4 pb-2 border-b border-gray-200">Manage</h3>
                <div class="flex gap-3 flex-wrap">
                    <a href="{{ route('admin.requests.index') }}"
                        class="bg-navy-900 text-white px-4 py-2 text-sm font-medium hover:bg-navy-800">View All
                        Requests</a>
                    <a href="{{ route('admin.officers.index') }}"
                        class="border border-navy-900 text-navy-900 px-4 py-2 text-sm font-medium hover:bg-navy-50">Manage
                        Officers</a>
                    <a href="{{ route('admin.ward-offices.index') }}"
                        class="border border-navy-900 text-navy-900 px-4 py-2 text-sm font-medium hover:bg-navy-50">Manage
                        Ward Offices</a>
                    <a href="{{ route('admin.document-types.index') }}"
                        class="border border-navy-900 text-navy-900 px-4 py-2 text-sm font-medium hover:bg-navy-50">Manage
                        Document Types</a>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
        <script>
            const navy = '#1F4E79';
            const green = '#2F5D3A';
            const maroon = '#7A2530';
            const gray = '#9CA3AF';

            // Status distribution — donut
            new Chart(document.getElementById('statusChart'), {
                type: 'doughnut',
                data: {
                    labels: @json($statusChart['labels']),
                    datasets: [{
                        data: @json($statusChart['data']),
                        backgroundColor: [gray, navy, green, maroon],
                        borderWidth: 0,
                    }]
                },
                options: {
                    plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } } }
                }
            });

            // By document type — horizontal bar
            new Chart(document.getElementById('typeChart'), {
                type: 'bar',
                data: {
                    labels: @json($typeChart->pluck('name')),
                    datasets: [{
                        data: @json($typeChart->pluck('document_requests_count')),
                        backgroundColor: navy,
                    }]
                },
                options: {
                    indexAxis: 'y',
                    plugins: { legend: { display: false } },
                    scales: { x: { ticks: { precision: 0 } } }
                }
            });

            // By ward office — bar
            new Chart(document.getElementById('wardChart'), {
                type: 'bar',
                data: {
                    labels: @json($wardChart->pluck('ward_number')),
                    datasets: [{
                        data: @json($wardChart->pluck('document_requests_count')),
                        backgroundColor: green,
                    }]
                },
                options: {
                    plugins: { legend: { display: false } },
                    scales: { y: { ticks: { precision: 0 } } }
                }
            });

            // Trend — line
            new Chart(document.getElementById('trendChart'), {
                type: 'line',
                data: {
                    labels: @json($trendChart->pluck('date')),
                    datasets: [{
                        label: 'Requests',
                        data: @json($trendChart->pluck('count')),
                        borderColor: navy,
                        backgroundColor: 'rgba(31, 78, 121, 0.08)',
                        fill: true,
                        tension: 0.2,
                    }]
                },
                options: {
                    plugins: { legend: { display: false } },
                    scales: { y: { ticks: { precision: 0 } } }
                }
            });
        </script>
    @endpush
</x-app-layout>