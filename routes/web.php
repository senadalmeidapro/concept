<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

// Todos Routes
Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
Route::get('/todos/{id}/edit', [TodoController::class, 'edit'])->name('todos.edit');
Route::put('/todos/{id}', [TodoController::class, 'update'])->name('todos.update');
Route::delete('/todos/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');
Route::patch('/todos/{id}/toggle', [TodoController::class, 'toggle'])->name('todos.toggle');

// Routes du jeu
Route::get('/game', [GameController::class, 'play'])->name('games.play');
Route::get('/scores', [GameController::class, 'index'])->name('games.scores');
Route::get('/top-scores', [GameController::class, 'topScores'])->name('games.top-scores');
Route::post('/scores', [GameController::class, 'store'])->name('games.store');

// Routes CRUD (administration)
Route::resource('games', GameController::class)->except(['create', 'store']);

// Portfolio Routes
Route::get('/', function () {
    return redirect()->route('portfolio.index');
})->name('portfolio.home');

Route::prefix('/portfolio')->group(function () {
    Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');
    Route::get('/create', [PortfolioController::class, 'create'])->name('portfolio.create');
    Route::post('/', [PortfolioController::class, 'store'])->name('portfolio.store');
    Route::get('/{id}/edit', [PortfolioController::class, 'edit'])->name('portfolio.edit');
    Route::put('/{id}', [PortfolioController::class, 'update'])->name('portfolio.update');
    Route::delete('/{id}', [PortfolioController::class, 'destroy'])->name('portfolio.destroy');
});
