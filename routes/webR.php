<?php

use App\Http\Controllers\DemandeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pdfController;
use App\Http\Controllers\TraitementController;

Route::middleware('auth')->group(function(){
    Route::get('/generate-pdf', [pdfController::class, 'generatePDF']);
    Route::get('/generate', [pdfController::class, 'generate']);
    Route::get('/index', [pdfController::class, 'index'])->name('index');
    Route:: post('/{demande}/validate',[TraitementController::class, 'validate'])->name('validate');
});



require __DIR__ . '/auth.php';

