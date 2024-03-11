<?php

use App\Http\Controllers\PurchaseHistoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('purchase-histories')->as('purchase-histories.')->group(function () {
 
    Route::get('/', [PurchaseHistoryController::class, 'index'])
        ->name('index');
});