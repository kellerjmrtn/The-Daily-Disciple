<?php

use App\Http\Controllers\Web\DevotionController;
use App\Http\Controllers\Web\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/all', [DevotionController::class, 'index'])->name('devotions.index');
