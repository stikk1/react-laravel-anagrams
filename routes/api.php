<?php

use App\Http\Controllers\WordbaseController;
use Illuminate\Support\Facades\Route;

Route::get('/wordbase/fetch', WordbaseController::class);
