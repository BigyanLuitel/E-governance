<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-navy-900 leading-tight">All Requests (System-Wide)</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-200 sm:rounded-md">

                {{-- Filter bar --}}
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <form method="GET" action="{{ route('admin.requests.index') }}"
                        class="flex gap-3 flex-wrap items-center">
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
                            <a href="{{ route('admin.requests.index') }}" class="text-sm text-navy-700 hover:underline">
                                Clear filters
                            </a>
                        @endif
                    </form>
                </div>

                @if ($requests->isEmpty())
                    <p class="text-ink-600 text-sm px-6 py-8">No requests match these filters.</p>
                @else
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200 text-ink-600">
                                <th class="py-3 px-6 font-semibold">Citizen</th>
                                <th class="py-3 px-6 font-semibold">Document Type</th>
                                <th class="py-3 px-6 font-semibold">Ward</th>
                                <th class="py-3 px-6 font-semibold">Status</th>
                                <th class="py-3 px-6 font-semibold">Submitted</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $req)
                                <tr class="border-b border-gray-100">
                                    <td class="py-3 px-6">{{ $req->citizen->name }}</td>
                                    <td class="py-3 px-6">{{ $req->documentType->name }}</td>
                                    <td class="py-3 px-6 text-ink-600">{{ $req->wardOffice->ward_number }}</td>
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

                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $requests->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>