<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TagController extends Controller
{
  public function generateTags(Request $request)
{
    $content = $request->input('content');

    if (!$content) {
        return response()->json(['error' => 'No content provided'], 400);
    }

    // OpenAI Client initialization
    $client = new \OpenAI\Client(env('OPENAI_API_KEY'));

    try {
        $response = $client->chat()->create([
            'model' => 'gpt-4.1-nano-2025-04-14',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Generate concise tags for the following text.',
                ],
                [
                    'role' => 'user',
                    'content' => $content,
                ],
            ],
            'max_tokens' => 50,
        ]);

        $tagsText = $response->choices[0]->message->content ?? '';

        // Process tags (split by comma or newline)
        $tags = array_filter(array_map('trim', preg_split('/[\n,]+/', $tagsText)));

        return response()->json(['tags' => $tags]);

    } catch (\Exception $e) {
        return response()->json(['error' => 'OpenAI API error: ' . $e->getMessage()], 500);
    }
}

}



