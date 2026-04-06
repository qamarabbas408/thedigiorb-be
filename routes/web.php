<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Login;

// SPA routes - serve React app for all non-admin routes
Route::view('/{any}', 'spa')->where('any', '^(?!admin).*$');

// Admin routes
Route::prefix('admin')->group(function () {
    require __DIR__ . '/admin.php';
});
