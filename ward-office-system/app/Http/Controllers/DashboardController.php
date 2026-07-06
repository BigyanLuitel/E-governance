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
    public function citizen()
    {
        return view('citizen.dashboard');
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

