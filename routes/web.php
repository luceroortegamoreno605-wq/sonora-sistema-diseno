<?php
use App\Http\Controllers\SonoraController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SonoraController::class, 'inicio'])->name('inicio');
Route::get('/playlist/{slug?}', [SonoraController::class, 'playlist'])->name('playlist');
Route::get('/reproductor', [SonoraController::class, 'reproductor'])->name('reproductor');
Route::get('/buscar', [SonoraController::class, 'buscar'])->name('buscar');