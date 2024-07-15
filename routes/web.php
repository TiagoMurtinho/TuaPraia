<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegionController;

Route::get('/', [HomeController::class, 'index'])->name('home');

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::middleware('auth')->group(function () {
    Route::get('/profile/{id}', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('attributes', AttributeController::class)->except('show', 'create');
    Route::resource('districts', \App\Http\Controllers\DistrictController::class)->except('show');
});

Route::resource('regions', RegionController::class)
    ->middleware(['auth', 'verified']);

Route::resource('locals', \App\Http\Controllers\LocalController::class)
    ->middleware(['auth', 'verified']);

Route::get('/storage/{path}', function ($path) {
    return response()->file(storage_path('app/public/' . $path));
});

/*Route::resource('attributes', AttributeController::class)
    ->middleware('auth');*/
//'verified' serve para quando o user faz a verificação de email

require __DIR__.'/auth.php';


