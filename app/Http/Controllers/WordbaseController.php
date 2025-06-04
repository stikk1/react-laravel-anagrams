<?php

namespace App\Http\Controllers;

use App\Jobs\FetchAndStoreWordbase;
use Illuminate\Http\JsonResponse;

class WordbaseController extends Controller
{
    public function __invoke(): JsonResponse
    {
        FetchAndStoreWordbase::dispatch();

        return response()->json(['message' => 'Words successfully fetched.'], 200);
    }
}
