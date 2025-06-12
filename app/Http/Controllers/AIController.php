<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{
    public function summarize(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $content = $request->input('content');

        // Your OpenAI API key and endpoint
        $apiKey = env('OPENAI_API_KEY');  // Store key in .env for security
        $model = 'gpt-4.1-nano-2025-04-14';

        $response = Http::withHeaders([
            'Authorization' => "Bearer $apiKey",
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => $model,
            'messages' => [
                ['role' => 'system', 'content' => 'Summarize the following note concisely.'],
                ['role' => 'user', 'content' => $content],
            ],
            'stream' => true,  // Enable streaming
        ]);

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to get AI response'], 500);
        }

        // Return streaming response to client
        return response()->stream(function () use ($response) {
            echo $response->body();
        }, 200, [
            'Content-Type' => 'text/event-stream',
            'Cache-Control' => 'no-cache',
            'Connection' => 'keep-alive',
        ]);
    }
}
