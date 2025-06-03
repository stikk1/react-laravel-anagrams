<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class WordbaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_words_can_be_fetched_and_saved_to_database(): void
    {
        $test = Http::fake([
            config('services.wordbase.url') => Http::response("word1\nword2\nword3", 200),
        ]);

        $response = $this->getJson(route('wordbase.fetch'));

        $response->assertStatus(200)->assertJson(['message' => 'Words successfully fetched.']);

        $this->assertDatabaseHas('words', ['word' => 'word1']);
        $this->assertDatabaseHas('words', ['word' => 'word2']);
        $this->assertDatabaseHas('words', ['word' => 'word3']);
    }

    public function test_wordbase_fetch_fails_on_bad_response(): void
    {
        Http::fake([
            config('wordbase.url') => Http::response(null, 404),
        ]);

        $response = $this->getJson(route('wordbase.fetch'));

        $response->assertStatus(404)
            ->assertJson(['message' => 'Words could not be fetched.']);
    }
}
