<?php

use App\Http\Controllers\DemandeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('demandes/validate', 'App\Http\Controllers\DemandeController@validate')->name('demandes.validate');
    Route::resource('demandes', DemandeController::class);

});
require __DIR__.'/auth.php';



