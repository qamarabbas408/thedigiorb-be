<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ContactController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/contacts', [ContactController::class, 'index']);
    Route::post('/contacts', [ContactController::class, 'store']);
    Route::get('/contacts/{id}', [ContactController::class, 'show']);
    Route::put('/contacts/{id}', [ContactController::class, 'update']);
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy']);

    Route::get('/portfolio/categories', [CategoryController::class, 'index']);
    Route::post('/portfolio/categories', [CategoryController::class, 'store']);
    Route::put('/portfolio/categories', [CategoryController::class, 'update']);
    Route::delete('/portfolio/categories', [CategoryController::class, 'destroy']);
});
