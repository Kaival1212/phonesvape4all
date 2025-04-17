<?php

use App\Livewire\Repair;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\StoreWelcome;
use App\Models\Store;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\R2UploadController;
use App\Livewire\RepairBrand;
use App\Livewire\RepairCategory;
use App\Livewire\RepairProduct;

Route::get('/', function () {
    $store = Store::where('slug', 'phonesvapes-4all-east-sheen')->firstOrFail();
    return app(StoreWelcome::class)->mountWith($store);
})->name('home');

Route::get('/store/phones4all-twickenham', function () {
    $store = Store::where('slug', 'phones4all-twickenham')->firstOrFail();
    return app(StoreWelcome::class)->mountWith($store);
})->name('store');

Route::get('/store/united-tech-vape-caterham', function () {
    $store = Store::where('slug', 'united-tech-vape-caterham')->firstOrFail();
    return app(StoreWelcome::class)->mountWith($store);
})->name('store.united-tech-vape-caterham');




Route::get('/services/repair', Repair::class)->name('repair');
Route::get('/services/repair/{categoriesSlug}', RepairBrand::class)->name('repair.category');
Route::get('/services/repair/{categoriesSlug}/{brandSlug}', RepairProduct::class)->name('repair.product');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

// Route::get('/admin', function() {
//     dd('admin');
// })->middleware(['auth', 'admin'])->name('admin');

require __DIR__.'/auth.php';
