<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\ProfileController;
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
    Route::get('/profile/{id}', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/{id}/update-photo', [ProfileController::class, 'updatePhoto'])->name('profile.update.photo');
    Route::patch('/profile/{id}/update_name', [ProfileController::class, 'updateName'])->name('profile.update_name');
    Route::patch('/profile/{id}/update_email', [ProfileController::class, 'updateEmail'])->name('profile.update_email');
    Route::patch('/profile/{id}/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
    Route::delete('/profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('attributes', AttributeController::class)->except('show', 'create');
    Route::resource('districts', \App\Http\Controllers\DistrictController::class)->except('show');
    Route::resource('regions', RegionController::class)->except('show');
    Route::resource('locals', \App\Http\Controllers\LocalController::class)
        ->except('show');
});

Route::get('/storage/{path}', function ($path) {
    return response()->file(storage_path('app/public/' . $path));
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
Route::get('locals', [LocalController::class, 'show'])->name('locals.show');
Route::get('locals/{id}', [LocalController::class, 'show'])->name('locals.show');

Route::get('/autocomplete-locals', [LocalController::class, 'autocomplete'])->name('locals.autocomplete');
Route::get('/search-results', [LocalController::class, 'searchResults'])->name('search.results');


Route::get('/storage/{path}', function ($path) {
    return response()->file(storage_path('app/public/' . $path));
});

require __DIR__.'/auth.php';


