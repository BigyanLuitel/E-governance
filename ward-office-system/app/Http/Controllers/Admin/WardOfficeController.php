<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WardOffice;
use Illuminate\Http\Request;

class WardOfficeController extends Controller
{
    public function index()
    {
        $wardOffices = WardOffice::withCount('documentRequests')->latest()->get();

        return view('admin.ward-offices-index', compact('wardOffices'));
    }

    public function create()
    {
        return view('admin.ward-offices-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ward_number' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        WardOffice::create($validated);

        return redirect()->route('admin.ward-offices.index')->with('success', 'Ward office created.');
    }
}