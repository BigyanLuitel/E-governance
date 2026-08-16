<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-navy-900 leading-tight">
            Officer Dashboard
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            <p class="text-ink-600 text-sm">
                Welcome, {{ auth()->user()->name }} —
                {{ auth()->user()->wardOffice->ward_number ?? 'No ward assigned' }}
            </p>

            {{-- Stats grid --}}
            <div
                class="grid grid-cols-2 md:grid-cols-4 gap-px bg-gray-200 border border-gray-200 sm:rounded-md overflow-hidden">
                <div class="bg-white p-4">
                    <p class="text-xs text-ink-600 uppercase tracking-wide">Total in Your Ward</p>
                    <p class="text-2xl font-bold text-navy-900 mt-1">{{ $stats['total'] }}</p>
                </div>
                <div class="bg-white p-4">
                    <p class="text-xs text-ink-600 uppercase tracking-wide">Pending</p>
                    <p class="text-2xl font-bold text-ink-900 mt-1">{{ $stats['pending'] }}</p>
                </div>
                <div class="bg-white p-4">
                    <p class="text-xs text-ink-600 uppercase tracking-wide">Under Review</p>
                    <p class="text-2xl font-bold text-navy-700 mt-1">{{ $stats['under_review'] }}</p>
                </div>
                <div class="bg-white p-4">
                    <p class="text-xs text-ink-600 uppercase tracking-wide">Approved</p>
                    <p class="text-2xl font-bold text-govgreen-800 mt-1">{{ $stats['approved'] }}</p>
                </div>
            </div>

            {{-- Charts --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="bg-white border border-gray-200 sm:rounded-md p-4">
                    <h3 class="font-semibold text-navy-900 mb-3 pb-2 border-b border-gray-200">Status Distribution</h3>
                    <div class="h-56">
                        <canvas id="officerStatusChart"></canvas>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 sm:rounded-md p-4">
                    <h3 class="font-semibold text-navy-900 mb-3 pb-2 border-b border-gray-200">Requests — Last 30 Days
                    </h3>
                    <div class="h-56">
                        <canvas id="officerTrendChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Recent requests needing attention --}}
            <div class="bg-white border border-gray-200 sm:rounded-md">
                <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
                    <h3 class="font-semibold text-navy-900">Requests Needing Review</h3>
                    <a href="{{ route('officer.requests.index') }}"
                        class="text-navy-700 text-sm font-medium hover:underline">
                        View all →
                    </a>
                </div>

                @if ($recentRequests->isEmpty())
                    <p class="text-ink-600 text-sm px-6 py-8">No pending or under-review requests right now.</p>
                @else
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200 text-ink-600">
                                <th class="py-3 px-6 font-semibold">Citizen</th>
                                <th class="py-3 px-6 font-semibold">Document Type</th>
                                <th class="py-3 px-6 font-semibold">Status</th>
                                <th class="py-3 px-6 font-semibold">Submitted</th>
                                <th class="py-3 px-6 font-semibold"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentRequests as $req)
                                <tr class="border-b border-gray-100">
                                    <td class="py-3 px-6">{{ $req->citizen->name }}</td>
                                    <td class="py-3 px-6">{{ $req->documentType->name }}</td>
                                    <td class="py-3 px-6">
                                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold uppercase tracking-wide
                                                                            @class([
                                                                                'text-ink-600' => $req->status === 'pending',
                                                                                'text-navy-700' => $req->status === 'under_review',
                                                                            ])">
                                            <span class="w-1.5 h-1.5 rounded-full @class([
                                                'bg-ink-600' => $req->status === 'pending',
                                                'bg-navy-700' => $req->status === 'under_review',
                                            ])"></span>
                                            {{ str_replace('_', ' ', $req->status) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-6 text-ink-600">{{ $req->created_at->format('M d, Y') }}</td>
                                    <td class="py-3 px-6 text-right">
                                        <a href="{{ route('officer.requests.show', $req) }}"
                                            class="text-navy-700 font-medium hover:underline">
                                            Review →
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
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

            new Chart(document.getElementById('officerStatusChart'), {
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
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } } }
                }
            });

            new Chart(document.getElementById('officerTrendChart'), {
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
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { y: { ticks: { precision: 0 } } }
                }
            });
        </script>
    @endpush
</x-app-layout>