<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\StatController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\TestimonialController;
use App\Http\Controllers\Api\UploadController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('api.key')->group(function () {
    Route::get('/contacts', [ContactController::class, 'index']);
    Route::post('/contacts', [ContactController::class, 'store']);
    Route::get('/contacts/{id}', [ContactController::class, 'show']);
    Route::put('/contacts/{id}', [ContactController::class, 'update']);
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy']);

    Route::get('/portfolio/categories', [CategoryController::class, 'index']);
    Route::post('/portfolio/categories', [CategoryController::class, 'store']);
    Route::put('/portfolio/categories', [CategoryController::class, 'update']);
    Route::delete('/portfolio/categories', [CategoryController::class, 'destroy']);

    Route::get('/portfolio/projects', [ProjectController::class, 'index']);
    Route::post('/portfolio/projects', [ProjectController::class, 'store']);
    Route::get('/portfolio/projects/{id}', [ProjectController::class, 'show']);
    Route::put('/portfolio/projects/{id}', [ProjectController::class, 'update']);
    Route::delete('/portfolio/projects/{id}', [ProjectController::class, 'destroy']);

    Route::get('/services', [ServiceController::class, 'index']);
    Route::post('/services', [ServiceController::class, 'store']);
    Route::get('/services/{id}', [ServiceController::class, 'show']);
    Route::put('/services/{id}', [ServiceController::class, 'update']);
    Route::delete('/services/{id}', [ServiceController::class, 'destroy']);

    Route::get('/settings', [SettingController::class, 'index']);
    Route::put('/settings', [SettingController::class, 'update']);

    Route::get('/stats', [StatController::class, 'index']);
    Route::post('/stats', [StatController::class, 'store']);
    Route::get('/stats/{id}', [StatController::class, 'show']);
    Route::put('/stats/{id}', [StatController::class, 'update']);
    Route::delete('/stats/{id}', [StatController::class, 'destroy']);

    Route::get('/team', [TeamController::class, 'index']);
    Route::post('/team', [TeamController::class, 'store']);
    Route::get('/team/{id}', [TeamController::class, 'show']);
    Route::put('/team/{id}', [TeamController::class, 'update']);
    Route::delete('/team/{id}', [TeamController::class, 'destroy']);

    Route::get('/testimonials', [TestimonialController::class, 'index']);
    Route::post('/testimonials', [TestimonialController::class, 'store']);
    Route::get('/testimonials/{id}', [TestimonialController::class, 'show']);
    Route::put('/testimonials/{id}', [TestimonialController::class, 'update']);
    Route::delete('/testimonials/{id}', [TestimonialController::class, 'destroy']);

    Route::post('/upload', [UploadController::class, 'store']);
});
