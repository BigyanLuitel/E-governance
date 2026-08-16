<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentRequest;
use App\Models\User;
use App\Models\WardOffice;
use App\Models\DocumentType;

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

    public function officer(Request $request)
    {
        $wardId = $request->user()->ward_office_id;

        $stats = [
            'total' => DocumentRequest::where('ward_office_id', $wardId)->count(),
            'pending' => DocumentRequest::where('ward_office_id', $wardId)->where('status', 'pending')->count(),
            'under_review' => DocumentRequest::where('ward_office_id', $wardId)->where('status', 'under_review')->count(),
            'approved' => DocumentRequest::where('ward_office_id', $wardId)->where('status', 'approved')->count(),
            'rejected' => DocumentRequest::where('ward_office_id', $wardId)->where('status', 'rejected')->count(),
        ];

        $statusChart = [
            'labels' => ['Pending', 'Under Review', 'Approved', 'Rejected'],
            'data' => [$stats['pending'], $stats['under_review'], $stats['approved'], $stats['rejected']],
        ];

        $trendChart = DocumentRequest::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('ward_office_id', $wardId)
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $recentRequests = DocumentRequest::where('ward_office_id', $wardId)
            ->whereIn('status', ['pending', 'under_review'])
            ->with(['citizen', 'documentType'])
            ->latest()
            ->take(5)
            ->get();

        return view('officer.dashboard', compact('stats', 'statusChart', 'trendChart', 'recentRequests'));
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

        $statusChart = [
            'labels' => ['Pending', 'Under Review', 'Approved', 'Rejected'],
            'data' => [$stats['pending'], $stats['under_review'], $stats['approved'], $stats['rejected']],
        ];

        $wardChart = WardOffice::withCount('documentRequests')->get();

        $typeChart = DocumentType::withCount('documentRequests')->get();

        $trendChart = DocumentRequest::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.dashboard', compact('stats', 'statusChart', 'wardChart', 'typeChart', 'trendChart'));
    }
}