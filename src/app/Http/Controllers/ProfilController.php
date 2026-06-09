<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TeamMember;
use App\Models\DivisionMember;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $activeRole = session('active_role')
            ?? $user?->roles->first()?->role_name
            ?? null;

        $layout = match ($activeRole) {
            'superadmin'  => 'superadmin.layouts.app',
            'admin'       => 'admin.layouts.app',
            'ketua_tim'   => 'ketuaTim.layouts.app',
            'pelatih'     => 'pelatih.layouts.app',
            'anggota_tim' => 'anggota.layouts.app',
            default       => 'anggota.layouts.app',
        };

        // Ambil tim user
        $teamMember = TeamMember::with('team')
            ->where('anggota_id', $user->id_user)
            ->first();

        // Ambil divisi user
        $divisionMember = DivisionMember::with('division')
            ->where('anggota_id', $user->id_user)
            ->first();

        // Ambil semua role user
        $roles = $user->roles->pluck('role_name')->implode(', ');

        return view('profil', [
            'title'          => 'Profil',
            'layout'         => $layout,
            'user'           => $user,
            'teamMember'     => $teamMember,
            'divisionMember' => $divisionMember,
            'roles'          => $roles,
        ]);
    }

    public function update(Request $request)
    {

        $user = Auth::user();

        $request->validate([
            'prodi'           => 'nullable|string|max:100',
            'fakultas'        => 'nullable|string|max:100',
            'no_hp'           => 'nullable|string|max:20',
            'username_github' => 'nullable|string|max:100',

            // upload foto
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {

            $path = $request->file('photo')
                ->store('profile-photos', 'public');

            $user->photo = $path;
        }

        $user->prodi = $request->prodi;
        $user->fakultas = $request->fakultas;
        $user->no_hp = $request->no_hp;
        $user->username_github = $request->username_github;

        $user->save();

        return redirect()
            ->route('profil')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}