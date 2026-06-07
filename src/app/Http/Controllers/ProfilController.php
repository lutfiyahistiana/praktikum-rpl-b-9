<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        $activeRole = session('active_role') ?? Auth::user()?->roles->first()?->role_name ?? null;

        $layout = match($activeRole) {
            'superadmin'  => 'superadmin.layouts.app',
            'admin'       => 'admin.layouts.app',
            'ketua_tim'   => 'ketua_tim.layouts.app',
            'pelatih'     => 'pelatih.layouts.app',
            'anggota_tim' => 'anggota.layouts.app',
            default       => 'anggota.layouts.app',
        };

        return view('profil', [
            'title'  => 'Profil',
            'layout' => $layout,
        ]);
    }
}