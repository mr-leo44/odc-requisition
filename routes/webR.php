<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pdfController;
use App\Http\Controllers\TraitementController;

Route::middleware(['auth', 'role:not-admin,user'])->group(function() {

Route::post('/{demande}/generatepdf', [pdfController::class, 'generate'])->name('generate');
Route::post('/{demande}/validate', [TraitementController::class, 'validate'])->name('validate');
Route::get('/index', [pdfController::class, 'index'])->name('index');
});


require __DIR__ . '/auth.php';
