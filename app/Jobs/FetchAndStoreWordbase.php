<?php

namespace App\Jobs;

use App\Models\Word;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;

class FetchAndStoreWordbase implements ShouldQueue
{
    use Queueable;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $url = config('services.wordbase.url');

        $response = Http::get($url);

        if (! $response->successful()) {
            return;
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
    }
}
