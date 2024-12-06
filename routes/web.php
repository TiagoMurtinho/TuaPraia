<?php

use App\Http\Controllers\{AttributeController,
    DistrictController,
    FeedbackController,
    FlagController,
    HomeController,
    ProfileController,
    RegionController,
    LocalController,
    SearchController};
use Illuminate\Support\Facades\Route;

// Rota inicial
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rotas protegidas por autenticação
Route::middleware('auth')->group(function () {
    // Rotas de perfil organizadas com prefixo e nome
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
    Route::resource('locals', LocalController::class)->except('show');
    Route::get('/feedback/{id}/edit', [FeedbackController::class, 'edit'])->name('feedback.edit');
    Route::put('/feedback/{id}', [FeedbackController::class, 'update'])->name('feedback.update');
    Route::delete('/feedback/{id}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');
    Route::post('/local/{id}/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::post('/flag/click', [FlagController::class, 'click']);
});

// Rotas públicas para visualizar recursos individuais
Route::get('/districts/{district}', [DistrictController::class, 'show'])->name('districts.show');
Route::get('/regions/{id}', [RegionController::class, 'show'])->name('regions.show');
Route::get('/locals/{id}', [LocalController::class, 'show'])->name('locals.show');
Route::get('/locals/{local}/feedback', [FeedbackController::class, 'index'])->name('feedback.index');

// Rota para autocomplete e resultados de pesquisa
Route::get('/autocomplete-locals', [SearchController::class, 'autocomplete'])->name('locals.autocomplete');
Route::get('/search-results', [SearchController::class, 'searchResults'])->name('search.results');
Route::get('/search-results', [SearchController::class, 'filterResults'])->name('filter.results');
Route::get('/regions/{regionId}/search-results', [SearchController::class, 'filterResults'])->name('filter.region_results');
Route::get('/districts/{districtId}/search-results', [SearchController::class, 'filterResults'])->name('filter.district_results');

// Rota para acessar arquivos de armazenamento
Route::get('/storage/{path}', function ($path) {
    return response()->file(storage_path('app/public/' . $path));
});

// Requerendo rotas de autenticação padrão
require __DIR__.'/auth.php';


