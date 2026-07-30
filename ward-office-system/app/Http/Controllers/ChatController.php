<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function ask(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:500',
        ]);

        try {
            $response = Http::timeout(15)->post('http://127.0.0.1:8001/chat', [
                'message' => $validated['message'],
            ]);

            if ($response->successful()) {
                return response()->json(['reply' => $response->json('response')]);
            }
        } catch (\Exception $e) {
            // fall through to fallback below
        }

        return response()->json([
            'reply' => "Sorry, the assistant is temporarily unavailable. Please try again later.",
        ]);
    }
}