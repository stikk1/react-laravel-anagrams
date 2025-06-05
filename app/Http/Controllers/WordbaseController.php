<?php

namespace App\Http\Controllers;

use App\Jobs\FetchAndStoreWordbase;
use Illuminate\Http\JsonResponse;

class WordbaseController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/wordbase/fetch",
     *     summary="Fetch the application wordbase",
     *     operationId="fetchWordbase",
     *     tags={"Wordbase"},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Fetch successful, job dispatched",
     *
     *         @OA\JsonContent(
     *             type="object",
     *
     *             @OA\Property(property="message", type="string", example="Words successfully fetched.")
     *         )
     *     ),
     * )
     */
    public function __invoke(): JsonResponse
    {
        FetchAndStoreWordbase::dispatch();

        return response()->json(['message' => 'Words successfully fetched.'], 200);
    }
}
