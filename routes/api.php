<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

// rutas públicas
Route::post('/register', [UserController::class, 'store']);
Route::post('/login',    [AuthController::class, 'login']);        

// rutas protegidas con Sanctum
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/user',    [UserController::class, 'show']);

    // validate-token 
    Route::get('/validate-token', [AuthController::class, 'validateToken']);
});
