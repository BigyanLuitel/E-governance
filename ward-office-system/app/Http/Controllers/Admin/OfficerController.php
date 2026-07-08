<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WardOffice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OfficerController extends Controller
{
    public function index()
    {
        $officers = User::where('role', 'officer')->with('wardOffice')->latest()->get();

        return view('admin.officers-index', compact('officers'));
    }

    public function create()
    {
        $wardOffices = WardOffice::all();

        return view('admin.officers-create', compact('wardOffices'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'ward_office_id' => 'required|exists:ward_offices,id',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'ward_office_id' => $validated['ward_office_id'],
            'role' => 'officer',
        ]);

        return redirect()->route('admin.officers.index')->with('success', 'Officer account created.');
    }
}