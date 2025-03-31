<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\StoreWelcome;
use App\Models\Store;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $store = Store::where('slug', 'phonesvapes-4all-east-sheen')->firstOrFail();
    return app(StoreWelcome::class)->mountWith($store);
})->name('home');


Route::get('/store/{slug}', function ($slug) {
    $store = Store::where('slug', $slug)->firstOrFail();
    return app(StoreWelcome::class)->mountWith($store);
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::get('/admin', function() {
    dd('admin');
})->middleware(['auth', 'admin'])->name('admin');

require __DIR__.'/auth.php';
