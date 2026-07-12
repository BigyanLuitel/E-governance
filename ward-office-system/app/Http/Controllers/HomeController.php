<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;

class HomeController extends Controller
{
    public function index()
    {
        $documentTypes = DocumentType::where('is_active', true)->get();

        return view('home', compact('documentTypes'));
    }
}