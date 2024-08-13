<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::resource('users', AdminController::class);
Route::put('/users/{user}/change-role', [AdminController::class, 'changeRole'])->name('users.changeRole');
Route::post('/users/{user}/activation', [AdminController::class, 'activateAccount'])->name('users.activation');