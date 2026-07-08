<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Requests — {{ $requests->first()?->wardOffice?->ward_number ?? 'Your Ward' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($requests->isEmpty())
                    <p class="text-gray-600">No requests found for your ward.</p>
                @else
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b">
                                <th class="py-2">Citizen</th>
                                <th class="py-2">Document Type</th>
                                <th class="py-2">Status</th>
                                <th class="py-2">Submitted</th>
                                <th class="py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $req)
                                <tr class="border-b">
                                    <td class="py-2">{{ $req->citizen->name }}</td>
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
                                    <td class="py-2">
                                        <a href="{{ route('officer.requests.show', $req) }}" class="text-blue-600 underline">
                                            Review
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $requests->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>