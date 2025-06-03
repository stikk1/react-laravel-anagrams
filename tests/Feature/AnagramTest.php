<?php

namespace Tests\Feature;

use App\Models\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnagramTest extends TestCase
{
    use RefreshDatabase;

    public function test_anagram_search_returns_correct_results()
    {
        Word::insert([
            ['word' => 'task'],
            ['word' => 'skat'],
            ['word' => 'kast'],
            ['word' => 'taks'],
            ['word' => 'hello'],
        ]);

        $query = 'task';

        $response = $this->getJson(route('anagrams.find', ['query' => $query]));

        $response->assertStatus(200);

        $words = collect($response->json('data'))->pluck('anagram')->all();

        $expectedWords = ['skat', 'kast', 'taks'];

        $this->assertEmpty(array_diff($expectedWords, $words));
        $this->assertEmpty(array_diff($words, $expectedWords));
    }

    public function test_anagram_search_returns_empty_if_none_found(): void
    {
        Word::insert([
            ['word' => 'hello'],
            ['word' => 'world'],
        ]);

        $response = $this->getJson(route('anagrams.find', ['query' => 'task']));

        $response->assertStatus(200)
            ->assertJson([
                'count' => 0,
                'data' => [],
            ]);
    }
}
