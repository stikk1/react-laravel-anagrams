<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class WordbaseController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $url = config('services.wordbase.url');

        $response = Http::get($url);

        if (! $response->successful()) {
            return response()->json(['message' => 'Words could not be fetched.'], 404);
        }

        $content = $response->body();

        $words = preg_split('/\r\n|\r|\n/', $content);

        $chunks = array_chunk($words, 100);

        foreach ($chunks as $chunk) {
            Word::insertOrIgnore(
                collect($chunk)
                    ->filter()
                    ->map(fn ($word) => ['word' => $word])
                    ->toArray()
            );
        }

        return response()->json(['message' => 'Words successfully fetched.'], 200);
    }
}
