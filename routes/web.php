<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;

Route::get('/', fn (): RedirectResponse => redirect()->route('sessions.create'));

Route::resource('users', UserController::class)->only(['create', 'store']);

Route::resource('sessions', SessionController::class)->only(['create', 'store']);

Route::middleware('auth')->group(function (): void {
    Route::delete('/sessions', [SessionController::class, 'destroy'])->name('sessions.destroy');

    Route::resource('expenses', ExpenseController::class)->except(['show']);
});
