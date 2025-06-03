<?php

use App\Http\Controllers\AnagramController;
use App\Http\Controllers\WordbaseController;
use Illuminate\Support\Facades\Route;

Route::get('/wordbase/fetch', WordbaseController::class)->name('wordbase.fetch');
Route::get('/anagrams/find/{query}', AnagramController::class)->name('anagrams.find');
