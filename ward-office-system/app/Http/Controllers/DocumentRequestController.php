<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentType;
use App\Models\DocumentRequest;
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
        if ($request->hasFile('uploaded_file')) {
            $filePath = $request->file('uploaded_file')->store('documents', 'public');
        }

        DocumentRequest::create([
            'citizen_id' => $request->user()->id,
            'document_type_id' => $validated['document_type_id'],
            'ward_office_id' => $request->user()->ward_office_id ?? 1,
            'purpose' => $validated['purpose'] ?? null,
            'form_data' => $validated['form_data'],
            'uploaded_file_path' => $filePath,
            'status' => 'pending',
        ]);

        return redirect()->route('citizen.dashboard')->with('success', 'Request submitted successfully.');
    }
}
