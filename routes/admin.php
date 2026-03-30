<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Projects\ProjectsIndex;
use App\Livewire\Admin\Categories\CategoriesIndex;
use App\Livewire\Admin\Services\ServicesIndex;
use App\Livewire\Admin\Stats\StatsIndex;
use App\Livewire\Admin\Team\TeamIndex;
use App\Livewire\Admin\Testimonials\TestimonialsIndex;
use App\Livewire\Admin\Contacts\ContactsIndex;
use App\Livewire\Admin\Settings\SettingsIndex;

Route::post('/logout', function () {
    session()->forget('admin_authenticated');
    return redirect('/');
})->name('admin.logout');

Route::middleware('admin.auth')->group(function () {
    Route::get('/', Dashboard::class)->name('admin.dashboard');
    Route::get('/projects', ProjectsIndex::class)->name('admin.projects');
    Route::get('/categories', CategoriesIndex::class)->name('admin.categories');
    Route::get('/services', ServicesIndex::class)->name('admin.services');
    Route::get('/stats', StatsIndex::class)->name('admin.stats');
    Route::get('/team', TeamIndex::class)->name('admin.team');
    Route::get('/testimonials', TestimonialsIndex::class)->name('admin.testimonials');
    Route::get('/contacts', ContactsIndex::class)->name('admin.contacts');
    Route::get('/settings', SettingsIndex::class)->name('admin.settings');
});
