<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Login;

// Root route shows admin login page
Route::get('/', Login::class)->name('admin.login');

Route::prefix('admin')->group(function () {
    require __DIR__ . '/admin.php';
});
