<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Citizen Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium">Your Requests</h3>
                    <a href="{{ route('requests.create') }}"
                        class="bg-gray-800 text-white px-4 py-2 rounded-md text-sm">
                        + New Request
                    </a>
                </div>

                @if ($requests->isEmpty())
                    <p class="text-gray-600">You haven't submitted any requests yet.</p>
                @else
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b">
                                <th class="py-2">Document Type</th>
                                <th class="py-2">Status</th>
                                <th class="py-2">Submitted</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $req)
                                <tr class="border-b">
                                    <td class="py-2">{{ $req->documentType->name }}</td>
                                    <td class="py-2">
                                        <span class="px-2 py-1 rounded text-xs
                                                    @class([
                                                        'bg-yellow-100 text-yellow-800' => $req->status === 'pending',
                                                        'bg-blue-100 text-blue-800' => $req->status === 'under_review',
                                                        'bg-green-100 text-green-800' => $req->status === 'approved',
                                                        'bg-red-100 text-red-800' => $req->status === 'rejected',
                                                    ])">
                                            {{ str_replace('_', ' ', $req->status) }}
                                        </span>
                                    </td>
                                    <td class="py-2">{{ $req->created_at->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>