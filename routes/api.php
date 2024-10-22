<?php

use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\WorkerProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Ruta para toda la informacion de perfil
Route::get('/worker-profiles', [WorkerProfileController::class, 'index']);
//Rutas para contacto
Route::get('/contacts', [ContactController::class, 'index']);
Route::post('/contacts', [ContactController::class, 'store']);
Route::get('/contacts/{id}', [ContactController::class, 'show']);
Route::put('/contacts/{id}', [ContactController::class, 'update']);
Route::delete('/contacts/{id}', [ContactController::class, 'destroy']);




