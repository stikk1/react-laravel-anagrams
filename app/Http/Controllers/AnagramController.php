<?php

namespace App\Http\Controllers;

use App\Http\Requests\FindAnagramRequest;
use App\Http\Resources\AnagramCollection;
use App\Models\Word;
use Illuminate\Support\Str;

class AnagramController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/anagrams/find/{query}",
     *     summary="Find anagrams for a given word",
     *     operationId="findAnagrams",
     *     tags={"Anagrams"},
     *
     *     @OA\Parameter(
     *         name="query",
     *         in="path",
     *         required=true,
     *         description="The word to search anagrams for",
     *
     *         @OA\Schema(type="string")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="List of anagrams",
     *
     *         @OA\JsonContent(
     *             type="object",
     *
     *             @OA\Property(property="count", type="integer", example=1),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *
     *                 @OA\Items(
     *                     type="object",
     *
     *                     @OA\Property(property="anagram", type="string", example="skat")
     *                 )
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
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
