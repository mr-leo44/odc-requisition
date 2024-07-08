<?php

use App\Http\Controllers\DemandeController;
use Illuminate\Support\Facades\Route;

    Route::get('demandes/historique', 'App\Http\Controllers\DemandeController@historique')->name('demandes.historique');
    Route::resource('demandes', DemandeController::class);

require __DIR__.'/auth.php';



