<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        return match ($user->role) {
            'citizen' => redirect()->route('citizen.dashboard'),
            'officer' => redirect()->route('officer.dashboard'),
            'admin' => redirect()->route('admin.dashboard'),
        };
    }
    public function citizen(Request $request)
    {
        $requests = $request->user()->documentRequests()->with('documentType')->latest()->get();

        return view('citizen.dashboard', compact('requests'));
    }
    public function officer()
    {
        return view('officer.dashboard');
    }
    public function admin()
    {
        return view('admin.dashboard');
    }

}

