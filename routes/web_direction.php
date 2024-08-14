<?php
use App\Http\Controllers\DirectionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->group(function(){
    
    Route::resource('directions', DirectionController::class);
});
require __DIR__.'/auth.php';