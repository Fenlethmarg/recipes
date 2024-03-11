<?php

use App\Http\Controllers\IngredientController;
use Illuminate\Support\Facades\Route;

Route::prefix('ingredients')->as('ingredients.')->group(function () {
        
    Route::get('/', [IngredientController::class, 'index'])
        ->name('index');
        
    Route::get('/{ingredient}', [IngredientController::class, 'show'])
        ->name('show');
});