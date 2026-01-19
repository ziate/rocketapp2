<?php

use App\Http\Controllers\Api\CustomerAreaController;
use App\Http\Controllers\Api\OrderApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Original Customer Areas API
Route::get('/customers/{customer}/areas', [CustomerAreaController::class, 'index']);

// Orders API
Route::apiResource('orders', OrderApiController::class);
Route::get('orders/status/{status}', [OrderApiController::class, 'byStatus']);
Route::get('orders/search', [OrderApiController::class, 'search']);
Route::get('orders-statistics', [OrderApiController::class, 'statistics']);
