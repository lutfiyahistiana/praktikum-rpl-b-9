<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TeamMember;
use App\Models\DivisionMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // WEB — Menampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // WEB — Proses login & redirect sesuai role
    public function prosesLogin(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user       = User::with('roles')->find(Auth::id());
            $activeRole = $user->roles->first()->role_name ?? null;

            // Simpan role aktif ke session
            session(['active_role' => $activeRole]);

            return $this->redirectByRole($activeRole);
        }

        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ])->onlyInput('email');
    }

    // WEB — Logout
    public function webLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // WEB — Switch Role
    public function switchRoleWeb(Request $request)
    {
        $request->validate(['role' => 'required|string']);

        $user      = User::with('roles')->find(Auth::id());
        $roleNames = $user->roles->pluck('role_name');

        if (!$roleNames->contains($request->role)) {
            abort(403, 'Role tidak ditemukan');
        }

        session(['active_role' => $request->role]);

        return $this->redirectByRole($request->role);
    }

    // HELPER — Redirect berdasarkan role
    private function redirectByRole(?string $role)
    {
        return match($role) {
            'superadmin'  => redirect()->route('superadmin.dashboard'),
            'admin'       => redirect()->route('admin.dashboard'),
            'ketua_tim'   => redirect()->route('ketua_tim.dashboard'),
            'pelatih'     => redirect()->route('pelatih.dashboard'),
            'anggota_tim' => redirect()->route('anggota_tim.dashboard'),
            default       => redirect()->route('login'),
        };
    }

    // API — Login (Mobile)
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::with('roles')
                    ->where('email', $request->email)
                    ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah',
            ], 401);
        }

        $activeRole = $user->roles->first()->role_name ?? 'auth_token';
        $token = $user->createToken($activeRole)->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data'    => [
                'token'   => $token,
                'id_user' => $user->id_user,
                'name'    => $user->name,
                'email'   => $user->email,
                'roles'   => $user->roles->pluck('role_name'),
            ],
        ]);
    }

    // API — Logout (Mobile)
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil',
        ]);
    }
    // API — Profile (Mobile)
    public function profile(Request $request)
    {
        $user = $request->user()->load('roles');

        $team = TeamMember::with('team')
            ->where('anggota_id', $user->id_user)
            ->first();

        $division = DivisionMember::with('division')
            ->where('anggota_id', $user->id_user)
            ->first();

        return response()->json([
            'success' => true,
            'message' => 'Data profile berhasil diambil',
            'data'    => [
                'id_user'         => $user->id_user,
                'name'            => $user->name,
                'nim'             => $user->nim,
                'email'           => $user->email,
                'prodi'           => $user->prodi,
                'fakultas'        => $user->fakultas,
                'no_hp'           => $user->no_hp,
                'username_github' => $user->username_github,
                'tim'             => $team     ? $team->team->team_name         : null,
                'divisi'          => $division ? $division->division->division_name : null,
                'roles'           => $user->roles->pluck('role_name'),
                'active_role'     => $request->user()->currentAccessToken()->name,
            ],
        ]);
    }

    // API — Switch Role (Mobile)
    public function switchRole(Request $request)
    {
        $request->validate(['role' => 'required|string']);

        $user      = $request->user()->load('roles');
        $roleNames = $user->roles->pluck('role_name');

        if (!$roleNames->contains($request->role)) {
            return response()->json([
                'success' => false,
                'message' => 'Role tidak ditemukan untuk user ini',
            ], 403);
        }

        $request->user()->currentAccessToken()->delete();
        $token = $user->createToken($request->role)->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Role berhasil diubah',
            'data'    => [
                'token'       => $token,
                'active_role' => $request->role,
            ],
        ]);
    }
}