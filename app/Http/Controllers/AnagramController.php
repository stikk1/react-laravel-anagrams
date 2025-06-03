<?php

namespace App\Http\Controllers;

use App\Http\Requests\FindAnagramRequest;
use App\Http\Resources\AnagramCollection;
use App\Models\Word;
use Illuminate\Support\Str;

class AnagramController extends Controller
{
    public function __invoke(FindAnagramRequest $request): AnagramCollection
    {
        $query = $request->validated()['query'];

        $letters = mb_str_split($query);
        $length = Str::length($query);

        sort($letters);

        $sortedQuery = implode('', $letters);

        $anagrams = Word::whereRaw('LENGTH(word) = ?', [$length])->get()
            ->filter(function ($word) use ($sortedQuery, $query) {
                $word = Str::lower($word->word);
                $letters = mb_str_split($word);

                sort($letters);

                $sortedWord = implode('', $letters);

                return $word !== $query && $sortedWord === $sortedQuery;
            });

        return new AnagramCollection($anagrams);
    }
}
