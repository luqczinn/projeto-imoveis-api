<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $user = User::create([
            "name"=> $validated['name'],
            "email"=> $validated['email'],
            "password"=> Hash::make($validated['password']),
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json(['ok' => true, 'user' => $user,'token'=> $token]);
    }   

    function login(LoginRequest $request)
    {
        $validated = $request->validated();
        
        if(Auth::attempt($validated)){
            $user = User::where('email', $validated['email'])->first();
            $token = $user->createToken('api-token')->plainTextToken;
            return response()->json(['ok'=> true,'user'=> $user, 'token'=> $token]);
        }

        return response()->json(['ok' => false, 'msg'=> 'Credenciais inválidas'], 401);
    }

    function logout(Request $request)
    {
        $token = $request->bearerToken();

        if(!$token)
            return response()->json(['ok'=> false,'msg'=> 'Token não informado'],400);

        $access_token = PersonalAccessToken::findToken($token);

        if(!$access_token)
            return response()->json(['ok'=> false,'msg'=> 'Token inválido'],400);

        $access_token->delete();
        
        return response()->json(['ok'=> true,'msg'=> 'Logout realizado com sucesso']);
    }
}
