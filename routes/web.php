<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegionController;

Route::get('/', function () {
    return view('home');
})->name('home');

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('regions', RegionController::class)
    ->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';

Route::resource('attributes', AttributeController::class)
    ->middleware(['auth', 'verified']);
