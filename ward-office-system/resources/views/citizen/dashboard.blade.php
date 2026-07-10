<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-navy-900 leading-tight">
            My Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 px-4 py-3 border-l-4 border-govgreen-800 bg-govgreen-50 text-govgreen-800 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white border border-gray-200 sm:rounded-md">
                <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
                    <h3 class="font-semibold text-navy-900">Your Requests</h3>
                    <a href="{{ route('requests.create') }}"
                        class="bg-navy-900 text-white px-4 py-2 text-sm font-medium hover:bg-navy-800">
                        + New Request
                    </a>
                </div>

                @if ($requests->isEmpty())
                    <p class="text-ink-600 text-sm px-6 py-8">You haven't submitted any requests yet.</p>
                @else
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200 text-ink-600">
                                <th class="py-3 px-6 font-semibold">Document Type</th>
                                <th class="py-3 px-6 font-semibold">Status</th>
                                <th class="py-3 px-6 font-semibold">Submitted</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $req)
                                <tr class="border-b border-gray-100">
                                    <td class="py-3 px-6">{{ $req->documentType->name }}</td>
                                    <td class="py-3 px-6">
                                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold uppercase tracking-wide
                                                    @class([
                                                        'text-ink-600' => $req->status === 'pending',
                                                        'text-navy-700' => $req->status === 'under_review',
                                                        'text-govgreen-800' => $req->status === 'approved',
                                                        'text-maroon-800' => $req->status === 'rejected',
                                                    ])">
                                            <span class="w-1.5 h-1.5 rounded-full @class([
                                                'bg-ink-600' => $req->status === 'pending',
                                                'bg-navy-700' => $req->status === 'under_review',
                                                'bg-govgreen-800' => $req->status === 'approved',
                                                'bg-maroon-800' => $req->status === 'rejected',
                                            ])"></span>
                                            {{ str_replace('_', ' ', $req->status) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-6 text-ink-600">{{ $req->created_at->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>