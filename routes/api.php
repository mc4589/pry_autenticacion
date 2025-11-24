<?php

use App\Http\Controllers\AuthController;//
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

// rutas públicas, no requieren que el usuario este autenticado
Route::post('/register', [UserController::class, 'store']);//creamos un nuevo usuario, con una ruta de tipo POST en la URl/registrer, cuando acceda ejecutara el metod store del UserController
Route::post('/login',    [AuthController::class, 'login']);// Ejecuta el método login del AuthController. Se usa para que un usuario inicie sesión y obtenga un token de acceso.   

// rutas protegidas con Sanctum, por tanto requieren autenticacion
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/user',    [UserController::class, 'show']);

    // validate-token 
    Route::get('/validate-token', [AuthController::class, 'validateToken']);
});
