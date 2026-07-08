<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentRequest;

class OfficerRequestController extends Controller
{

    public function index(Request $request)
    {
        $officer = $request->user();

        $requests = DocumentRequest::where('ward_office_id', $officer->ward_office_id)
            ->with(['citizen', 'documentType'])
            ->latest()
            ->paginate(10);

        return view('officer.requests-index', compact('requests'));
    }
    public function show(DocumentRequest $documentRequest)
    {
        abort_if($documentRequest->ward_office_id !== auth()->user()->ward_office_id, 403);
        $documentRequest->load(['citizen', 'documentType', 'statusLogs.changedBy']);
        return view('officer.requests-show', ['req' => $documentRequest]);
    }
    public function update(Request $request, DocumentRequest $documentRequest)
    {
        abort_if($documentRequest->ward_office_id !== auth()->user()->ward_office_id, 403);

        $validated = $request->validate([
            'status' => 'required|in:pending,under_review,approved,rejected',
            'remarks' => 'nullable|string',
        ]);

        $documentRequest->updateStatus(
            $validated['status'],
            $request->user(),
            $validated['remarks'] ?? null
        );

        return redirect()->route('officer.requests.show', $documentRequest)
            ->with('success', 'Request status updated successfully.');
    }
}

