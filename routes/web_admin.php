<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::resource('users', AdminController::class);
