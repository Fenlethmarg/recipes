<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('orders')->as('orders.')->group(function () {
 
    Route::post('/', [OrderController::class, 'store'])
        ->name('store');
        
    Route::get('/', [OrderController::class, 'index'])
        ->name('index');

    Route::post('/{order}/ready', [OrderController::class, 'orderReady'])
        ->name('orderReady');
});