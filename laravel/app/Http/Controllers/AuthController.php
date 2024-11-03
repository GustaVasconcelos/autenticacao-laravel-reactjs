<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Services\UserService;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->userService->register($request->validated());

        return response()->json(['message' => 'Usuário registrado com sucesso', 'user' => $user], 201);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Credenciais inválidas'], 401);
            }
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Erro no servidor'], 500);
        }

        return response()->json(['token' => $token]);
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Logout realizado com sucesso']);
    }
}
