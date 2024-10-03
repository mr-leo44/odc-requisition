<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('admin', AdminController::class)->only(['index', 'store']);
    Route::put('/admin/{user}/change-role', [AdminController::class, 'changeRole'])->name('users.changeRole');
    Route::post('/admin/{user}/activation', [AdminController::class, 'activateAccount'])->name('users.activation');
    Route::get('/admin/{user}/activation', [AdminController::class, 'activateAccount'])->name('users.activation');
});
