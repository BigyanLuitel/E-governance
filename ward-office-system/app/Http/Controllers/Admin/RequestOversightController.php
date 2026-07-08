<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentRequest;
use App\Models\DocumentType;
use App\Models\WardOffice;
use Illuminate\Http\Request;

class RequestOversightController extends Controller
{
    public function index(Request $request)
    {
        $query = DocumentRequest::with(['citizen', 'documentType', 'wardOffice']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('ward_office_id')) {
            $query->where('ward_office_id', $request->ward_office_id);
        }

        if ($request->filled('document_type_id')) {
            $query->where('document_type_id', $request->document_type_id);
        }

        $requests = $query->latest()->paginate(15)->withQueryString();

        return view('admin.requests-index', [
            'requests' => $requests,
            'wardOffices' => WardOffice::all(),
            'documentTypes' => DocumentType::all(),
        ]);
    }
}