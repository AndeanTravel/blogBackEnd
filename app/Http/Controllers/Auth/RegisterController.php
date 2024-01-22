<?php

namespace App\Http\Controllers\Auth;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Validar los datos 
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Si la validación falla
        if ($validator->fails()) {
            return response()->json(['registro falló' => $validator->errors()], 422);
        }

        // Crear un nuevo usuario
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Crear un token de acceso para el nuevo usuario
        $token = $user->createToken('AccessToken')->accessToken;

        // Devolver una respuesta con el token
        return response()->json(['token' => $token], 201);
    }
}
