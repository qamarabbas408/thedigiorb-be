<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/portfolio', [HomeController::class, 'portfolio'])->name('portfolio');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'submitContact'])->name('contact.submit');

// Admin routes
Route::prefix('admin')->group(function () {
    require __DIR__ . '/admin.php';
});
