<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Role;
use App\Models\Division;
use App\Models\DivisionMember;
use App\Models\Team;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Hash;

class ManageRoleController extends Controller
{
    public function showManageRole()
    {
        $divisions = Division::all();
        $teams = Team::all();

        $users = User::with('roles')->get()->map(function ($user) {
            $divisionMember = DivisionMember::where('anggota_id', $user->id_user)->first();
            $teamMember = TeamMember::where('anggota_id', $user->id_user)->first();

            return [
                'id_user'          => $user->id_user,
                'name'             => $user->name,
                'nim'              => $user->nim ?? '-',
                'email'            => $user->email,
                'prodi'            => $user->prodi ?? '-',
                'fakultas'         => $user->fakultas ?? '-',
                'no_hp'            => $user->no_hp ?? '-',
                'username_github'  => $user->username_github ?? '-',
                'divisi'           => $divisionMember ? $divisionMember->division->division_name : '-',
                'divisi_id'        => $divisionMember ? $divisionMember->division_id : '',
                'tim'              => $teamMember ? $teamMember->team->team_name : '-',
                'tim_id'           => $teamMember ? $teamMember->team_id : '',
                'roles'            => $user->roles->pluck('id_role')->toArray(),
            ];
        });

        $rolesList = Role::all();

        $data = array(
            'title'          => 'Manage Role',
            'menuManageRole' => 'active',
            'users'          => $users,
            'divisions'      => $divisions,
            'teams'          => $teams,
            'rolesList'      => $rolesList,
        );
        return view('superadmin.manageRole', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email',
            'role'     => 'required|exists:roles,id_role',
        ]);

        // Check if user already exists
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            $request->validate([
                'password' => 'required|string|min:6',
            ]);

            $user = User::create([
                'name'       => $request->name,
                'email'      => $request->email,
                'password'   => Hash::make($request->password),
                'created_by' => auth()->user()->id_user,
            ]);
        }

        // Check if user already has this role
        $existing = UserRole::where('id_user', $user->id_user)
                            ->where('id_role', $request->role)
                            ->first();

        if (!$existing) {
            UserRole::create([
                'id_user' => $user->id_user,
                'id_role' => $request->role,
            ]);
        }

        return redirect()->route('superadmin.manageRole')->with('success', 'Akun berhasil ditambahkan');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'name'    => 'required|string|max:255',
            'roles'   => 'array',
        ]);

        $user = User::findOrFail($request->id_user);

        $updateData = [
            'name'            => $request->name,
            'nim'             => $request->nim,
            'prodi'           => $request->prodi,
            'fakultas'        => $request->fakultas,
            'no_hp'           => $request->no_hp,
            'username_github' => $request->username_github,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        // Update Division
        DivisionMember::where('anggota_id', $user->id_user)->delete();
        if ($request->filled('division_id')) {
            DivisionMember::create([
                'division_id' => $request->division_id,
                'anggota_id'  => $user->id_user,
            ]);
        }

        // Update Team
        TeamMember::where('anggota_id', $user->id_user)->delete();
        if ($request->filled('team_id')) {
            TeamMember::create([
                'team_id'    => $request->team_id,
                'anggota_id' => $user->id_user,
            ]);
        }

        // Update Roles
        if ($request->has('roles')) {
            $roles = $request->roles;
            UserRole::where('id_user', $user->id_user)->delete();
            foreach ($roles as $roleId) {
                UserRole::create([
                    'id_user' => $user->id_user,
                    'id_role' => $roleId,
                ]);
            }
        }

        return redirect()->route('superadmin.manageRole')->with('success', 'Data akun berhasil diperbarui');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id_user',
        ]);

        $user = User::findOrFail($request->id_user);

        TeamMember::where('anggota_id', $user->id_user)->delete();
        DivisionMember::where('anggota_id', $user->id_user)->delete();
        UserRole::where('id_user', $user->id_user)->delete();
        
        $user->delete();

        return redirect()->route('superadmin.manageRole')->with('success', 'Akun berhasil dihapus!');
    }
}
