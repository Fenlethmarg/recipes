<?php

use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

Route::prefix('stocks')->as('stocks.')->group(function () {
 
    Route::post('/prepare', [StockController::class, 'prepareIngredients'])
        ->name('prepareIngredients');

    Route::get('/', [StockController::class, 'index'])
        ->name('index');
});