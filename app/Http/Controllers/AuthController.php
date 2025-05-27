<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password))
        {
            throw ValidationException::withMessages([
                'email' => ['Email atau Password Salah']
            ]);
        }

        $user->tokens()->delete();

        $user->update([
            'is_active' => 1
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'access_token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->update([
            'is_active' => 0
        ]);

        $request->user()->currentAccessToken()->delete();

        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Berhasil Logout']);
    }

    public function getAllUser()
    {
        $users = User::all();
        return response()->json($users);
    }
}
