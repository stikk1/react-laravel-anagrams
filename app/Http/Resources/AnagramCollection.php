<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AnagramCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'count' => $this->collection->count(),
            'data' => $this->collection
                ->map(fn ($item) => ['anagram' => $item->word])
                ->values()
                ->toArray(),
        ];
    }
}
