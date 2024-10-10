<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('users', UserController::class)->only(['create', 'store']);

Route::resource('sessions', SessionController::class)->only(['create', 'store']);

Route::delete('/sessions', [SessionController::class, 'destroy'])->name('sessions.destroy')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::resource('expenses', ExpenseController::class);
});
