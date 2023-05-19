<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\SanctumAuthController;

Route::prefix('v1')->group(function() {
    Route::apiResource('/api-customers', CustomerController::class);
    Route::apiResource('/api-products', ProductController::class);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [SanctumAuthController::class, 'register']);
Route::post('/login', [SanctumAuthController::class, 'login']);