<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    if (Session::get('authUser') !== null) {
        return redirect()->route('demandes.index');
    } else {
        return redirect()->route('login');
    }
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.index')->middleware('auth');

require __DIR__ . '/auth.php';
require __DIR__ . '/demande_route.php';
require __DIR__ . '/webR.php';
require __DIR__ . '/web_approbateur.php';
require __DIR__ . '/web_direction.php';
