<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentType;

class DocumentTypeController extends Controller
{
    public function index()
    {
        $documentTypes = DocumentType::withCount('documentRequests')->get();

        return view('admin.document-types-index', compact('documentTypes'));
    }

    public function toggle(DocumentType $documentType)
    {
        $documentType->update(['is_active' => !$documentType->is_active]);

        return redirect()->route('admin.document-types.index')
            ->with('success', "{$documentType->name} is now " . ($documentType->is_active ? 'active' : 'inactive') . '.');
    }
}