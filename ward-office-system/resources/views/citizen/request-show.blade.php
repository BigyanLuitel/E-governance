<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-navy-900 leading-tight">
            Request #{{ $req->id }} — {{ $req->documentType->name }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Current status banner --}}
            <div class="px-4 py-3 border-l-4 @class([
                'border-ink-600 bg-gray-50 text-ink-900' => $req->status === 'pending',
                'border-navy-700 bg-navy-50 text-navy-900' => $req->status === 'under_review',
                'border-govgreen-800 bg-govgreen-50 text-govgreen-800' => $req->status === 'approved',
                'border-maroon-800 bg-maroon-50 text-maroon-800' => $req->status === 'rejected',
            ])">
                <p class="font-semibold capitalize">
                    Status: {{ str_replace('_', ' ', $req->status) }}
                </p>
                @if ($req->status === 'rejected' && $req->officer_remarks)
                    <p class="text-sm mt-1">
                        <span class="font-medium">Reason:</span> {{ $req->officer_remarks }}
                    </p>
                @elseif ($req->status === 'approved' && $req->officer_remarks)
                    <p class="text-sm mt-1">{{ $req->officer_remarks }}</p>
                @endif
            </div>

            {{-- Request details --}}
            <div class="bg-white border border-gray-200 sm:rounded-md p-6">
                <h3 class="font-semibold text-navy-900 mb-4 pb-2 border-b border-gray-200">Request Details</h3>

                <dl class="grid grid-cols-2 gap-y-4 gap-x-6 text-sm">
                    <div>
                        <dt class="text-ink-600">Document Type</dt>
                        <dd class="font-medium">{{ $req->documentType->name }}</dd>
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
                    <dt class="text-ink-600 mb-2">Submitted Details</dt>
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
                            View Your Uploaded Document →
                        </a>
                    </div>
                @endif
            </div>

            {{-- Status History --}}
            <div class="bg-white border border-gray-200 sm:rounded-md p-6">
                <h3 class="font-semibold text-navy-900 mb-4 pb-2 border-b border-gray-200">Status History</h3>

                @if ($req->statusLogs->isEmpty())
                    <p class="text-ink-600 text-sm">No status changes yet.</p>
                @else
                    <ol class="relative border-l-2 border-gray-200 ml-2">
                        @foreach ($req->statusLogs as $log)
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
                                    {{ $log->created_at->format('M d, Y, H:i') }}
                                </p>
                                @if ($log->remarks)
                                    <p class="text-sm mt-1 text-ink-600 italic">"{{ $log->remarks }}"</p>
                                @endif
                            </li>
                        @endforeach
                    </ol>
                @endif
            </div>
            @if ($req->status === 'approved' && $req->issued_letter_path)
                <div class="bg-white border border-gray-200 sm:rounded-md p-6">
                    <h3 class="font-semibold text-navy-900 mb-2">Recommendation Letter</h3>
                    <p class="text-sm text-ink-600 mb-3">
                        Your recommendation letter has been issued. Reference No.
                        <span class="font-medium text-navy-900">{{ $req->reference_number }}</span>
                    </p>
                    <a href="{{ Storage::url($req->issued_letter_path) }}" target="_blank"
                        class="bg-navy-900 text-white px-4 py-2 text-sm font-medium hover:bg-navy-800 inline-block">
                        Download Your Letter
                    </a>
                </div>
            @endif

            <a href="{{ route('citizen.dashboard') }}" class="text-sm text-navy-700 hover:underline">
                ← Back to Dashboard
            </a>

        </div>
    </div>
</x-app-layout>