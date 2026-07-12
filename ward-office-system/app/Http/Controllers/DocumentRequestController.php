<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentType;
use App\Models\DocumentRequest;
use Illuminate\Support\Facades\Http;

class DocumentRequestController extends Controller
{
    public function create()
    {
        $documentTypes = DocumentType::where('is_active', true)->get();

        return view('citizen.request-create', compact('documentTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'document_type_id' => 'required|exists:document_types,id',
            'purpose' => 'nullable|string',
            'form_data' => 'required|array',
            'uploaded_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $filePath = null;
        $fileValidation = null;

        if ($request->hasFile('uploaded_file')) {
            $uploadedFile = $request->file('uploaded_file');
            $filePath = $uploadedFile->store('documents', 'public');

            $fileValidation = $this->validateFileWithMLService($uploadedFile);
        }

        DocumentRequest::create([
            'citizen_id' => $request->user()->id,
            'document_type_id' => $validated['document_type_id'],
            'ward_office_id' => $request->user()->ward_office_id ?? 1,
            'purpose' => $validated['purpose'] ?? null,
            'form_data' => $validated['form_data'],
            'uploaded_file_path' => $filePath,
            'file_validation' => $fileValidation,
            'status' => 'pending',
        ]);

        return redirect()->route('citizen.dashboard')->with('success', 'Request submitted successfully.');
    }
    public function show(DocumentRequest $documentRequest)
    {
        abort_if($documentRequest->citizen_id !== auth()->id(), 403);

        $documentRequest->load(['documentType', 'statusLogs.changedBy']);

        return view('citizen.request-show', ['req' => $documentRequest]);
    }
    private function validateFileWithMLService($uploadedFile): ?array
    {
        try {
            $response = Http::timeout(5)->attach(
                'file',
                file_get_contents($uploadedFile->getRealPath()),
                $uploadedFile->getClientOriginalName()
            )->post('http://127.0.0.1:8001/validate-file');

            if ($response->successful()) {
                return $response->json();
            }
        } catch (\Exception $e) {
            // ML service unreachable — fail gracefully, don't block submission
            return null;
        }

        return null;
    }
}
