<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', 'api/documentation');
Route::get('/docs', function () {
    return response()->file(storage_path('api-docs/api-docs.json'), [
        'Content-Type' => 'application/json',
    ]);
})->name('l5-swagger.default.docs');
