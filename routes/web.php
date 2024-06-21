<?php

use App\Http\Controllers\DiasFestivosController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas dias festivos
    Route::prefix('dias-festivos')->group(function () {
        Route::get('/', [DiasFestivosController::class, 'index'])->name('dias-festivos.index');
        Route::get('/create', [DiasFestivosController::class, 'create'])->name('dias-festivos.create');
        Route::post('/', [DiasFestivosController::class,'store'])->name('dias-festivos.store');
        Route::get('/{diasFestivos}/edit', [DiasFestivosController::class, 'edit'])->name('dias-festivos.edit');
        Route::get('/{diasFestivos}', [DiasFestivosController::class, 'show'])->name('dias-festivos.show');
        Route::put('/{diasFestivos}', [DiasFestivosController::class, 'update'])->name('dias-festivos.update');
        Route::delete('/{diasFestivos}', [DiasFestivosController::class, 'destroy'])->name('dias-festivos.destroy');
    });
});

require __DIR__.'/auth.php';
