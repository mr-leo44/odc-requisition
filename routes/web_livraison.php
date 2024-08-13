<?php

use App\Http\Controllers\DemandeController;
use Illuminate\Support\Facades\Route;

Route::post('/demandes/show', [DemandeController::class, 'updateLivraison'])->name('demandes.updateLivraison');


require __DIR__.'/auth.php';
