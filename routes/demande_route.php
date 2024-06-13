<?php

use App\Http\Controllers\DemandeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::resource('demandes', DemandeController::class);
});
require __DIR__.'/auth.php';



