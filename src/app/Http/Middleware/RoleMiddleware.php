<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Penggunaan di routes: middleware('role:admin') atau middleware('role:admin,superadmin')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Belum login → redirect ke halaman login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Ambil semua role milik user yang sedang login
        $userRoles = Auth::user()->roles->pluck('role_name')->toArray();

        // Cek apakah salah satu role user cocok dengan role yang diizinkan
        foreach ($roles as $role) {
            if (in_array($role, $userRoles)) {
                return $next($request);
            }
        }

        // Tidak ada role yang cocok maka tolak akses
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}