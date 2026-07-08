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
}

