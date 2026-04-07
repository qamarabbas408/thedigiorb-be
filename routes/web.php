<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Livewire\Admin\Login;

Route::get('/', HomeController::class)->name('home');

Route::get('/login', Login::class)->name('admin.login');

Route::prefix('admin')->group(function () {
    require __DIR__ . '/admin.php';
});
