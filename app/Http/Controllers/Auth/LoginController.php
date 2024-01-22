<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(Request $request)
    {  
               
        
        $credentials = $request->only('email', 'password');
        

        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            $token = $user->createToken('tokenInicio')->accessToken;

            return response()->json(['token' => $token], 200);
        }

        return response()->json(['error' => 'credenciales incorrectas'], 401);
    }
}
