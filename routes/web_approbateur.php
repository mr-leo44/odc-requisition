<?php
use App\Http\Controllers\approbateurController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->group(function(){    
    Route::put('/approbateurs/update', [ApprobateurController::class, 'update'])->name('approbateurs.updateAll');
    Route::post('/update-levels', [ApprobateurController::class, 'updateLevels'])->name('update.levels');        
    Route::resource('approbateurs', ApprobateurController::class)->except(
        'update'
    );
});
require __DIR__.'/auth.php';