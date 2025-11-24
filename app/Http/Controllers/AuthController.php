<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facedes\Hash;

class AuthController extends Controller
{
    //Login de usuarios
    public function login(Request $request)
    {
        $request->validate([
            'email'   => 'required|email',
            'password => 'required|string',
        ]);
        
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Credenciales incorrectas'
            ], 401);
        }
        
        $user  = $request->user();
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
                'message' => 'Login exitoso',
                'token'   => $token,
                'user'    => $user,
                'perfil'  => $user->perfil
            ],200);
    //Validacion de tokens 
    public function validateToken(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'valid'  => true,
            'user'   => $user,
            'perfil' => $user->perfil ?? 'usuario'
        ], 200);
    }
}
