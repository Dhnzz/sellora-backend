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
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau Password Salah'],
            ]);
        }

        $user->tokens()->delete();

        $user->update([
            'is_active' => 1,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Berhasil Login!',
            'user' => $user,
            'access_token' => $token,
        ]);
    }

    public function me(Request $request)
    {
        switch ($request->user()->getRoleNames()->first()) {
            case 'superAdmin':
                $profil = $request->user()->admins;
                break;
            case 'admin':
                $profil = $request->user()->admins;
                break;
            case 'sales':
                $profil = $request->user()->sales;
                break;
            case 'customer':
                $profil = $request->user()->customers;
                break;

            default:
                $profil = 'Tidak Memiliki profil';
                break;
        }

        $data = [
            'email' => $request->user()->email,
            'profil' => $profil,
            'role' => $request->user()->roles,
            'is_active' => $request->user()->is_active,
        ];
        return $data;
    }

    public function getPermissions()
    {
        $permissions = Auth::user()->getAllPermissions()->pluck('name');
        return response()->json($permissions);
    }

    public function logout(Request $request)
    {
        $request->user()->update([
            'is_active' => 0,
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
