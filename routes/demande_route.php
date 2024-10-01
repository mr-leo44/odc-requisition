<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemandeController;

Route::middleware(['auth', 'role:not-admin,user,livraison'])->group(function() {
    Route::get('demandes/historique', 'App\Http\Controllers\DemandeController@historique')->name('demandes.historique');
    Route::resource('demandes', DemandeController::class)->only(['index', 'store', 'destroy']);
});

require __DIR__.'/auth.php';
