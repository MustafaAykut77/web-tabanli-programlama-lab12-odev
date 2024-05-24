<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;

Route::get('/', [UrlController::class, 'index']);
Route::post('/shorten', [UrlController::class, 'store'])->name('shorten');
Route::get('/{shortCode}', [UrlController::class, 'show']);
