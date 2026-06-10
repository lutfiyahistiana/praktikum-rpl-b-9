<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageRoleController extends Controller
{
    public function showManageRole()
    {
        $usersData = \App\Models\User::whereDoesntHave('roles', function($q) {
            $q->where('roles.id_role', 1);
        })->get();
        $users = [];

        foreach ($usersData as $user) {
            $teamName = '-';
            $teamId = '';
            $teamMember = \App\Models\TeamMember::with('team')->where('anggota_id', $user->id_user)->first();
            if ($teamMember && $teamMember->team) {
                $teamName = $teamMember->team->team_name;
                $teamId = $teamMember->team->id_team;
            }

            $divName = '-';
            $divId = '';
            $divMember = \App\Models\DivisionMember::with('division')->where('anggota_id', $user->id_user)->first();
            if ($divMember && $divMember->division) {
                $divName = $divMember->division->division_name;
                $divId = $divMember->division->id_division;
            }

            $users[] = [
                'id_user' => $user->id_user,
                'name' => $user->name,
                'username_github' => $user->username_github ?? '',
                'nim' => $user->nim ?? '-',
                'prodi' => $user->prodi ?? '-',
                'fakultas' => $user->fakultas ?? '-',
                'no_hp' => $user->no_hp ?? '-',
                'divisi' => $divName,
                'divisi_id' => $divId,
                'tim' => $teamName,
                'tim_id' => $teamId,
            ];
        }

        $teams = \App\Models\Team::all();
        $divisions = \App\Models\Division::all();

        $data = array(
            'title'         => 'Manage',
            'menuManage'    => 'active',
            'users'         => $users,
            'teams'         => $teams,
            'divisions'     => $divisions,
            'rawUsers'      => $usersData,
        );
        return view('admin.manageRole', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'role' => 'required|exists:roles,id_role',
        ]);

        // Prevent assigning Superadmin role (id_role = 1)
        if ($request->role == 1) {
            return redirect()->back()->withErrors(['role' => 'Anda tidak bisa menambahkan hak akses Superadmin.'])->withInput();
        }

        $user = \App\Models\User::where('email', $request->email)->first();

        if ($user) {
            $isSuperadmin = \Illuminate\Support\Facades\DB::table('user_roles')
                ->where('id_user', $user->id_user)
                ->where('id_role', 1)
                ->exists();

            if ($isSuperadmin) {
                return redirect()->back()->withErrors(['email' => 'Anda tidak bisa menambahkan hak akses ke akun Superadmin.'])->withInput();
            }
        }

        if (!$user) {
            // User doesn't exist, create it
            $request->validate([
                'name' => 'required|string|max:100',
                'password' => 'required|min:6',
            ]);

            $user = \App\Models\User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => \Illuminate\Support\Facades\Hash::make($request->password),
                'created_by' => auth()->id(),
            ]);
        }

        // Check if user already has this role
        $existingRole = \Illuminate\Support\Facades\DB::table('user_roles')
            ->where('id_user', $user->id_user)
            ->where('id_role', $request->role)
            ->first();

        if (!$existingRole) {
            \Illuminate\Support\Facades\DB::table('user_roles')->insert([
                'id_user' => $user->id_user,
                'id_role' => $request->role,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('admin.manageRole')->with('success', 'Berhasil menambahkan hak akses ke akun tersebut.');
    }

    public function updateAccount(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'name' => 'required|string|max:100',
        ]);

        $user = \App\Models\User::find($request->id_user);
        
        $isSuperadmin = \Illuminate\Support\Facades\DB::table('user_roles')
            ->where('id_user', $user->id_user)
            ->where('id_role', 1)
            ->exists();

        if ($isSuperadmin) {
            return redirect()->back()->withErrors(['error' => 'Anda tidak diizinkan mengubah data akun Superadmin.']);
        }
        
        $updateData = [
            'name' => $request->name,
            'username_github' => $request->username_github,
            'nim' => $request->nim,
            'prodi' => $request->prodi,
            'fakultas' => $request->fakultas,
            'no_hp' => $request->no_hp,
        ];

        if (!empty($request->password)) {
            $updateData['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
        }

        $user->update($updateData);

        // Update Tim
        if ($request->filled('team_id')) {
            \App\Models\TeamMember::updateOrCreate(
                ['anggota_id' => $user->id_user],
                ['team_id' => $request->team_id]
            );
        } else {
            \App\Models\TeamMember::where('anggota_id', $user->id_user)->delete();
        }

        // Update Divisi
        if ($request->filled('division_id')) {
            \App\Models\DivisionMember::updateOrCreate(
                ['anggota_id' => $user->id_user],
                ['division_id' => $request->division_id]
            );
        } else {
            \App\Models\DivisionMember::where('anggota_id', $user->id_user)->delete();
        }

        return redirect()->route('admin.manageRole')->with('success', 'Data akun berhasil diperbarui!');
    }
}
