<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Request #{{ $req->id }} — {{ $req->documentType->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="p-4 bg-green-100 text-green-800 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Citizen & Request Details --}}
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-medium mb-4">Request Details</h3>

                <dl class="grid grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm text-gray-500">Citizen</dt>
                        <dd>{{ $req->citizen->name }} ({{ $req->citizen->email }})</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Document Type</dt>
                        <dd>{{ $req->documentType->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Current Status</dt>
                        <dd class="capitalize">{{ str_replace('_', ' ', $req->status) }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Submitted</dt>
                        <dd>{{ $req->created_at->format('M d, Y') }}</dd>
                    </div>
                </dl>

                @if ($req->purpose)
                    <div class="mt-4">
                        <dt class="text-sm text-gray-500">Purpose</dt>
                        <dd>{{ $req->purpose }}</dd>
                    </div>
                @endif

                <div class="mt-4">
                    <dt class="text-sm text-gray-500 mb-2">Submitted Form Data</dt>
                    <dd>
                        <ul class="list-disc list-inside">
                            @foreach ($req->form_data as $field => $value)
                                <li><span class="capitalize">{{ str_replace('_', ' ', $field) }}</span>: {{ $value }}</li>
                            @endforeach
                        </ul>
                    </dd>
                </div>

                @if ($req->uploaded_file_path)
                    <div class="mt-4">
                        <a href="{{ Storage::url($req->uploaded_file_path) }}" target="_blank"
                            class="text-blue-600 underline">
                            View Uploaded Document
                        </a>
                    </div>
                @endif
            </div>

            {{-- Status Update Form --}}
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-medium mb-4">Update Status</h3>

                <form method="POST" action="{{ route('officer.requests.update', $req) }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">New Status</label>
                        <select name="status" class="mt-1 block w-full rounded-md border-gray-300" required>
                            <option value="pending" @selected($req->status === 'pending')>Pending</option>
                            <option value="under_review" @selected($req->status === 'under_review')>Under Review</option>
                            <option value="approved" @selected($req->status === 'approved')>Approved</option>
                            <option value="rejected" @selected($req->status === 'rejected')>Rejected</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Remarks</label>
                        <textarea name="remarks" class="mt-1 block w-full rounded-md border-gray-300"
                            rows="3"></textarea>
                    </div>

                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md">
                        Update Status
                    </button>
                </form>
            </div>

            {{-- Status History --}}
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-medium mb-4">Status History</h3>

                @if ($req->statusLogs->isEmpty())
                    <p class="text-gray-600">No status changes yet.</p>
                @else
                    <ul class="space-y-2">
                        @foreach ($req->statusLogs as $log)
                            <li class="text-sm border-b pb-2">
                                <span class="font-medium">{{ str_replace('_', ' ', $log->old_status ?? 'created') }}</span>
                                →
                                <span class="font-medium">{{ str_replace('_', ' ', $log->new_status) }}</span>
                                by {{ $log->changedBy->name }} on {{ $log->created_at->format('M d, Y H:i') }}
                                @if ($log->remarks)
                                    <br><span class="text-gray-500">"{{ $log->remarks }}"</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>