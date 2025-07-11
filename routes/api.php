<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserController::class, 'register'])->name('users.register');
Route::post('/login', [UserController::class, 'login'])->name('users.login');

// Protected Routes (Require Token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');
    Route::middleware('role:admin')->group(function () {
    Route::post('/change-role', [UserController::class, 'change_user_role'])->name('users.changeRole');
    });
});
