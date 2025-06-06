<?php

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

Route::get('/docs', function () {
    return response()->file(storage_path('api-docs/api-docs.json'), [
        'Content-Type' => 'application/json',
    ]);
})->name('l5-swagger.default.docs');

Route::get('/{any}', function () {
    $index = public_path('index.html');

    return Response::file($index);
})->where('any', '.*');
