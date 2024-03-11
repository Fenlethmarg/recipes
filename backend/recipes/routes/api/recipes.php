<?php

use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::prefix('recipes')->as('recipes.')->group(function () {
        
    Route::get('/', [RecipeController::class, 'index'])
        ->name('index');

    Route::get('/random', [RecipeController::class, 'getRandom'])
        ->name('getRandom');

    Route::get('/{recipe}', [RecipeController::class, 'show'])
        ->name('show');
});