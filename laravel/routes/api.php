<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Rotas de autenticação
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login'); // Nome da rota
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

// Rota de teste
Route::get('/teste', function (Request $request) {
    return response()->json(['message' => 'Rota de teste funcionando!'], 200);
});

// Rotas de usuário, requer autenticação
Route::middleware('auth:api')->group(function () {
    Route::get('/users', [UserController::class, 'getAllUsers']);
    Route::get('/users/{id}', [UserController::class, 'getUser']);
});
