<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::with('roles')
                    ->where('email', $request->email)
                    ->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah'
            ], 401);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data' => [
                'token' => $token,
                'id_user' => $user->id_user,
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $user->roles->pluck('role_name')
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil'
        ]);
    }

    public function profile(Request $request)
    {
        $user = $request->user()->load('roles');

        return response()->json([
            'success' => true,
            'message' => 'Data profile berhasil diambil',
            'data' => [
                'id_user' => $user->id_user,
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $user->roles->pluck('role_name'),
                'active_role' => $request->user()->currentAccessToken()->name
            ]
        ]);
    }

    public function switchRole(Request $request)
    {
        $request->validate([
            'role' => 'required|string'
        ]);

        $user = $request->user()->load('roles');
        $roleNames = $user->roles->pluck('role_name');

        if (!$roleNames->contains($request->role)) {
            return response()->json([
                'success' => false,
                'message' => 'Role tidak ditemukan untuk user ini'
            ], 403);
        }

        // Hapus token lama, buat token baru dengan nama role aktif
        $request->user()->currentAccessToken()->delete();
        $token = $user->createToken($request->role)->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Role berhasil diubah',
            'data' => [
                'token' => $token,
                'active_role' => $request->role
            ]
        ]);
    }
}