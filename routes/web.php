<?php

use App\Http\Controllers\{
    AttributeController,
    DistrictController,
    HomeController,
    ProfileController,
    RegionController,
    LocalController
};
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('{id}', [ProfileController::class, 'index'])->name('index');
        Route::get('{id}/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('{id}/update-photo', [ProfileController::class, 'updatePhoto'])->name('update.photo');
        Route::patch('{id}/update-name', [ProfileController::class, 'updateName'])->name('update.name');
        Route::patch('{id}/update-email', [ProfileController::class, 'updateEmail'])->name('update.email');
        Route::patch('{id}/update-password', [ProfileController::class, 'updatePassword'])->name('update.password');
        Route::delete('{id}', [ProfileController::class, 'destroy'])->name('destroy');
    });

    Route::resource('attributes', AttributeController::class)->except(['show', 'create']);
    Route::resource('districts', DistrictController::class)->except('show');
    Route::resource('regions', RegionController::class)->except('show');
    Route::resource('locals', LocalController::class);
});

Route::get('/districts/{district}', [DistrictController::class, 'show'])->name('districts.show');
Route::get('/regions/{id}', [RegionController::class, 'show'])->name('regions.show');

Route::get('/storage/{path}', function ($path) {
    return response()->file(storage_path('app/public/' . $path));
});

require __DIR__.'/auth.php';


