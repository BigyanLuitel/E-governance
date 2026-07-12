<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;

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

    public function issueLetter(DocumentRequest $documentRequest)
    {
        abort_if($documentRequest->ward_office_id !== auth()->user()->ward_office_id, 403);
        abort_if($documentRequest->status !== 'approved', 400, 'Only approved requests can have a letter issued.');

        if (!$documentRequest->reference_number) {
            $documentRequest->reference_number = $documentRequest->generateReferenceNumber();
        }

        $template = match ($documentRequest->documentType->slug) {
            'birth_certificate' => 'letters.birth-certificate',
            'death_certificate' => 'letters.death-certificate',
            'marriage_certificate' => 'letters.marriage-certificate',
            'citizenship_recommendation' => 'letters.citizenship-recommendation',
            default => throw new InvalidArgumentException(
                'Unsupported document type slug: ' . $documentRequest->documentType->slug
            ),
        };

        $pdf = Pdf::loadView($template, ['request' => $documentRequest]);

        $filename = 'letters/' . $documentRequest->reference_number . '.pdf';
        Storage::disk('public')->put($filename, $pdf->output());

        $documentRequest->update([
            'issued_letter_path' => $filename,
            'letter_issued_at' => now(),
        ]);

        return redirect()->route('officer.requests.show', $documentRequest)
            ->with('success', 'Recommendation letter generated successfully.');
    }
}

