<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserController::class, 'register'])->name('users.register');
Route::post('/login', [UserController::class, 'login'])->name('users.login');

// Protected Routes (Require Token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');
    Route::get('/user', [UserController::class, 'getLoggedInUser'])->name('user.loggedInUser');

    Route::middleware('role_or_above:admin')->group(function () {
        Route::post('/change-role', [UserController::class, 'changeUserRole'])->name('users.changeUserRole');
    });

    Route::middleware('role_or_above:manager')->group(function () {
        Route::get('/users', [UserController::class, 'getUsers'])->name('users.getUsers');
        Route::get('/users/{id}', [UserController::class, 'getUser'])->name('users.getUser');
    });
});
