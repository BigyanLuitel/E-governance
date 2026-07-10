<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-navy-900 leading-tight">
            Request #{{ $req->id }} — {{ $req->documentType->name }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="px-4 py-3 border-l-4 border-govgreen-800 bg-govgreen-50 text-govgreen-800 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Citizen & Request Details --}}
            <div class="bg-white border border-gray-200 sm:rounded-md p-6">
                <h3 class="font-semibold text-navy-900 mb-4 pb-2 border-b border-gray-200">Request Details</h3>

                <dl class="grid grid-cols-2 gap-y-4 gap-x-6 text-sm">
                    <div>
                        <dt class="text-ink-600">Citizen</dt>
                        <dd class="font-medium">{{ $req->citizen->name }} ({{ $req->citizen->email }})</dd>
                    </div>
                    <div>
                        <dt class="text-ink-600">Document Type</dt>
                        <dd class="font-medium">{{ $req->documentType->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-ink-600">Current Status</dt>
                        <dd class="font-medium capitalize">{{ str_replace('_', ' ', $req->status) }}</dd>
                    </div>
                    <div>
                        <dt class="text-ink-600">Submitted</dt>
                        <dd class="font-medium">{{ $req->created_at->format('M d, Y') }}</dd>
                    </div>
                </dl>

                @if ($req->purpose)
                    <div class="mt-4 pt-4 border-t border-gray-100 text-sm">
                        <dt class="text-ink-600">Purpose</dt>
                        <dd class="font-medium">{{ $req->purpose }}</dd>
                    </div>
                @endif

                <div class="mt-4 pt-4 border-t border-gray-100 text-sm">
                    <dt class="text-ink-600 mb-2">Submitted Form Data</dt>
                    <dd>
                        <ul class="space-y-1">
                            @foreach ($req->form_data as $field => $value)
                                <li>
                                    <span class="text-ink-600 capitalize">{{ str_replace('_', ' ', $field) }}:</span>
                                    <span class="font-medium">{{ $value }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </dd>
                </div>

                @if ($req->uploaded_file_path)
                    <div class="mt-4 pt-4 border-t border-gray-100 text-sm">
                        <a href="{{ Storage::url($req->uploaded_file_path) }}" target="_blank"
                            class="text-navy-700 font-medium hover:underline">
                            View Uploaded Document →
                        </a>

                        @if ($req->file_validation)
                            <div class="mt-2 px-3 py-2 border-l-4 text-sm @class([
                                'border-govgreen-800 bg-govgreen-50 text-govgreen-800' => $req->file_validation['valid'],
                                'border-maroon-800 bg-maroon-50 text-maroon-800' => !$req->file_validation['valid'],
                            ])">
                                <p class="font-semibold">
                                    {{ $req->file_validation['valid'] ? 'File quality check passed' : 'File quality check flagged issues' }}
                                </p>
                                @if (!empty($req->file_validation['issues']))
                                    <ul class="list-disc list-inside mt-1">
                                        @foreach ($req->file_validation['issues'] as $issue)
                                            <li>{{ $issue }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                <p class="text-xs mt-1 opacity-75">
                                    Blur score: {{ $req->file_validation['blur_score'] }} · Brightness:
                                    {{ $req->file_validation['brightness_score'] }}
                                </p>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            {{-- Status Update Form --}}
            <div class="bg-white border border-gray-200 sm:rounded-md p-6">
                <h3 class="font-semibold text-navy-900 mb-4 pb-2 border-b border-gray-200">Update Status</h3>

                <form method="POST" action="{{ route('officer.requests.update', $req) }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-ink-900 mb-1">New Status</label>
                        <select name="status" class="block w-full rounded-md border-gray-300 text-sm" required>
                            <option value="pending" @selected($req->status === 'pending')>Pending</option>
                            <option value="under_review" @selected($req->status === 'under_review')>Under Review</option>
                            <option value="approved" @selected($req->status === 'approved')>Approved</option>
                            <option value="rejected" @selected($req->status === 'rejected')>Rejected</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-ink-900 mb-1">Remarks</label>
                        <textarea name="remarks" class="block w-full rounded-md border-gray-300 text-sm"
                            rows="3"></textarea>
                    </div>

                    <button type="submit"
                        class="bg-navy-900 text-white px-4 py-2 text-sm font-medium hover:bg-navy-800">
                        Update Status
                    </button>
                </form>
            </div>

            {{-- Status History — ledger-style timeline --}}
            <div class="bg-white border border-gray-200 sm:rounded-md p-6">
                <h3 class="font-semibold text-navy-900 mb-4 pb-2 border-b border-gray-200">Status History</h3>

                @if ($req->statusLogs->isEmpty())
                    <p class="text-ink-600 text-sm">No status changes yet.</p>
                @else
                    <ol class="relative border-l-2 border-gray-200 ml-2">
                        @foreach ($req->statusLogs as $index => $log)
                            <li class="mb-6 ml-5 last:mb-0">
                                <span class="absolute -left-[9px] flex items-center justify-center w-4 h-4 rounded-full border-2 border-white
                                            @class([
                                                'bg-govgreen-800' => $log->new_status === 'approved',
                                                'bg-maroon-800' => $log->new_status === 'rejected',
                                                'bg-navy-700' => !in_array($log->new_status, ['approved', 'rejected']),
                                            ])">
                                </span>
                                <p class="text-sm font-semibold text-ink-900 capitalize">
                                    {{ str_replace('_', ' ', $log->old_status ?? 'created') }} →
                                    {{ str_replace('_', ' ', $log->new_status) }}
                                </p>
                                <p class="text-xs text-ink-600 mt-0.5">
                                    {{ $log->changedBy->name }} · {{ $log->created_at->format('M d, Y, H:i') }}
                                </p>
                                @if ($log->remarks)
                                    <p class="text-sm mt-1 text-ink-600 italic">"{{ $log->remarks }}"</p>
                                @endif
                            </li>
                        @endforeach
                    </ol>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>