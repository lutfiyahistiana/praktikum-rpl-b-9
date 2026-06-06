<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // GET /users
    public function index()
    {
        $users = User::with('roles')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data users berhasil diambil',
            'data' => $users->map(function ($user) {
                return [
                    'id_user' => $user->id_user,
                    'name' => $user->name,
                    'email' => $user->email,
                    'roles' => $user->roles->pluck('role_name'),
                    'created_at' => $user->created_at,
                ];
            })
        ]);
    }

    // GET /users/{id_user}
    public function show($id)
    {
        $user = User::with('roles')->find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data user berhasil diambil',
            'data' => [
                'id_user' => $user->id_user,
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $user->roles->pluck('role_name'),
                'created_at' => $user->created_at,
            ]
        ]);
    }

    // POST /users
    public function store(Request $request)
{
    $request->validate([
        'name'            => 'required|string|max:100',
        'email'           => 'required|email|unique:users,email',
        'password'        => 'required|min:8',
        'roles'           => 'required|array',
        'roles.*'         => 'exists:roles,role_name',
        'prodi'           => 'nullable|string|max:100',
        'fakultas'        => 'nullable|string|max:100',
        'no_hp'           => 'nullable|string|max:20',
        'username_github' => 'nullable|string|max:100',
    ]);

    $user = User::create([
        'name'            => $request->name,
        'email'           => $request->email,
        'password'        => Hash::make($request->password),
        'created_by'      => $request->user()->id_user,
        'prodi'           => $request->prodi,
        'fakultas'        => $request->fakultas,
        'no_hp'           => $request->no_hp,
        'username_github' => $request->username_github,
    ]);

    $roleIds = Role::whereIn('role_name', $request->roles)->pluck('id_role');
    $user->roles()->attach($roleIds);

    return response()->json([
        'success' => true,
        'message' => 'User berhasil dibuat',
        'data' => [
            'id_user'         => $user->id_user,
            'name'            => $user->name,
            'email'           => $user->email,
            'prodi'           => $user->prodi,
            'fakultas'        => $user->fakultas,
            'no_hp'           => $user->no_hp,
            'username_github' => $user->username_github,
            'roles'           => $request->roles,
        ]
    ], 201);
}

    // PUT /users/{id_user}
public function update(Request $request, $id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'User tidak ditemukan'
        ], 404);
    }

    $request->validate([
        'name'            => 'sometimes|string|max:100',
        'email'           => 'sometimes|email|unique:users,email,' . $id . ',id_user',
        'password'        => 'sometimes|min:8',
        'prodi'           => 'sometimes|nullable|string|max:100',
        'fakultas'        => 'sometimes|nullable|string|max:100',
        'no_hp'           => 'sometimes|nullable|string|max:20',
        'username_github' => 'sometimes|nullable|string|max:100',
    ]);

    if ($request->has('name'))            $user->name = $request->name;
    if ($request->has('email'))           $user->email = $request->email;
    if ($request->has('password'))        $user->password = Hash::make($request->password);
    if ($request->has('prodi'))           $user->prodi = $request->prodi;
    if ($request->has('fakultas'))        $user->fakultas = $request->fakultas;
    if ($request->has('no_hp'))           $user->no_hp = $request->no_hp;
    if ($request->has('username_github')) $user->username_github = $request->username_github;

    $user->save();

    return response()->json([
        'success' => true,
        'message' => 'User berhasil diupdate',
        'data' => [
            'id_user'         => $user->id_user,
            'name'            => $user->name,
            'email'           => $user->email,
            'prodi'           => $user->prodi,
            'fakultas'        => $user->fakultas,
            'no_hp'           => $user->no_hp,
            'username_github' => $user->username_github,
        ]
    ]);
}

    // DELETE /users/{id_user}
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User berhasil dihapus'
        ]);
    }

    // GET /roles
    public function getRoles()
    {
        $roles = Role::all();

        return response()->json([
            'success' => true,
            'message' => 'Data roles berhasil diambil',
            'data' => $roles
        ]);
    }

    // POST /users/{id_user}/roles
    public function addRole(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'role' => 'required|exists:roles,role_name',
        ]);

        $role = Role::where('role_name', $request->role)->first();

        if ($user->roles->contains('id_role', $role->id_role)) {
            return response()->json([
                'success' => false,
                'message' => 'User sudah memiliki role ini'
            ], 409);
        }

        $user->roles()->attach($role->id_role);

        return response()->json([
            'success' => true,
            'message' => 'Role berhasil ditambahkan',
            'data' => [
                'id_user' => $user->id_user,
                'roles' => $user->roles()->pluck('role_name')
            ]
        ]);
    }

    // DELETE /users/{id_user}/roles/{id_role}
    public function removeRole($id, $id_role)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        $user->roles()->detach($id_role);

        return response()->json([
            'success' => true,
            'message' => 'Role berhasil dihapus',
            'data' => [
                'id_user' => $user->id_user,
                'roles' => $user->roles()->pluck('role_name')
            ]
        ]);
    }
}