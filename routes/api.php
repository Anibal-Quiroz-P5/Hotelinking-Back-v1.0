<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PromotionalCodeController;



Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/promotional-codes', [PromotionalCodeController::class, 'store']);

/* Route::get('/promotional-codes', [PromotionalCodeController::class, 'index']); */
Route::post('/promotional-codes/{code}/exchange', [PromotionalCodeController::class, 'exchange']);

Route::get('/offers', [OfferController::class, 'index']);

Route::post('/promotional-codes/{offerId}/generate', [PromotionalCodeController::class, 'generate']);






