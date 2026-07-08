<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentRequest;
use App\Models\User;
use App\Models\WardOffice;
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
        $stats = [
            'total_requests' => DocumentRequest::count(),
            'pending' => DocumentRequest::where('status', 'pending')->count(),
            'under_review' => DocumentRequest::where('status', 'under_review')->count(),
            'approved' => DocumentRequest::where('status', 'approved')->count(),
            'rejected' => DocumentRequest::where('status', 'rejected')->count(),
            'total_officers' => User::where('role', 'officer')->count(),
            'total_ward_offices' => WardOffice::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

}

