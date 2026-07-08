<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Requests (System-Wide)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Filter form --}}
                <form method="GET" action="{{ route('admin.requests.index') }}" class="flex gap-4 mb-6 flex-wrap">
                    <select name="status" class="rounded-md border-gray-300 text-sm" onchange="this.form.submit()">
                        <option value="">All Statuses</option>
                        @foreach (['pending', 'under_review', 'approved', 'rejected'] as $status)
                            <option value="{{ $status }}" @selected(request('status') === $status)>
                                {{ str_replace('_', ' ', ucfirst($status)) }}
                            </option>
                        @endforeach
                    </select>

                    <select name="ward_office_id" class="rounded-md border-gray-300 text-sm"
                        onchange="this.form.submit()">
                        <option value="">All Wards</option>
                        @foreach ($wardOffices as $ward)
                            <option value="{{ $ward->id }}" @selected(request('ward_office_id') == $ward->id)>
                                {{ $ward->ward_number }} — {{ $ward->municipality }}
                            </option>
                        @endforeach
                    </select>

                    <select name="document_type_id" class="rounded-md border-gray-300 text-sm"
                        onchange="this.form.submit()">
                        <option value="">All Document Types</option>
                        @foreach ($documentTypes as $type)
                            <option value="{{ $type->id }}" @selected(request('document_type_id') == $type->id)>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>

                    @if (request()->anyFilled(['status', 'ward_office_id', 'document_type_id']))
                        <a href="{{ route('admin.requests.index') }}" class="text-sm text-gray-500 underline self-center">
                            Clear filters
                        </a>
                    @endif
                </form>

                @if ($requests->isEmpty())
                    <p class="text-gray-600">No requests match these filters.</p>
                @else
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b">
                                <th class="py-2">Citizen</th>
                                <th class="py-2">Document Type</th>
                                <th class="py-2">Ward</th>
                                <th class="py-2">Status</th>
                                <th class="py-2">Submitted</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $req)
                                <tr class="border-b">
                                    <td class="py-2">{{ $req->citizen->name }}</td>
                                    <td class="py-2">{{ $req->documentType->name }}</td>
                                    <td class="py-2">{{ $req->wardOffice->ward_number }}</td>
                                    <td class="py-2">
                                        <span class="px-2 py-1 rounded text-xs @class([
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

                    <div class="mt-4">
                        {{ $requests->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>