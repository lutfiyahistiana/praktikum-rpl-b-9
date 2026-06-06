<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\DivisionMember;
use App\Models\User;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    // GET /divisions
    public function index()
    {
        $divisions = Division::with('ketua')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data divisi berhasil diambil',
            'data' => $divisions->map(function ($division) {
                return [
                    'id_division' => $division->id_division,
                    'division_name' => $division->division_name,
                    'ketua_division_id' => $division->ketua_division_id,
                    'ketua_name' => $division->ketua->name ?? null,
                ];
            })
        ]);
    }

    // GET /divisions/{id}
    public function show($id)
    {
        $division = Division::with('ketua', 'members.user')->find($id);

        if (!$division) {
            return response()->json([
                'success' => false,
                'message' => 'Divisi tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data divisi berhasil diambil',
            'data' => [
                'id_division' => $division->id_division,
                'division_name' => $division->division_name,
                'ketua_division_id' => $division->ketua_division_id,
                'ketua_name' => $division->ketua->name ?? null,
                'members' => $division->members->map(function ($member) {
                    return [
                        'id_user' => $member->anggota_id,
                        'name' => $member->user->name ?? null,
                    ];
                }),
            ]
        ]);
    }

    // POST /divisions
    public function store(Request $request)
    {
        $request->validate([
            'division_name' => 'required|string',
            'ketua_division_id' => 'required|exists:users,id_user',
        ]);

        $division = Division::create([
            'division_name' => $request->division_name,
            'ketua_division_id' => $request->ketua_division_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Divisi berhasil dibuat',
            'data' => [
                'id_division' => $division->id_division,
                'division_name' => $division->division_name,
                'ketua_division_id' => $division->ketua_division_id,
            ]
        ], 201);
    }

    // PUT /divisions/{id}
    public function update(Request $request, $id)
    {
        $division = Division::find($id);

        if (!$division) {
            return response()->json([
                'success' => false,
                'message' => 'Divisi tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'division_name' => 'sometimes|string',
            'ketua_division_id' => 'sometimes|exists:users,id_user',
        ]);

        if ($request->has('division_name')) $division->division_name = $request->division_name;
        if ($request->has('ketua_division_id')) $division->ketua_division_id = $request->ketua_division_id;

        $division->save();

        return response()->json([
            'success' => true,
            'message' => 'Divisi berhasil diupdate',
            'data' => [
                'id_division' => $division->id_division,
                'division_name' => $division->division_name,
                'ketua_division_id' => $division->ketua_division_id,
            ]
        ]);
    }

    // DELETE /divisions/{id}
    public function destroy($id)
    {
        $division = Division::find($id);

        if (!$division) {
            return response()->json([
                'success' => false,
                'message' => 'Divisi tidak ditemukan'
            ], 404);
        }

        $division->delete();

        return response()->json([
            'success' => true,
            'message' => 'Divisi berhasil dihapus'
        ]);
    }

    // GET /divisions/{id}/members
    public function getMembers($id)
    {
        $division = Division::with('members.user')->find($id);

        if (!$division) {
            return response()->json([
                'success' => false,
                'message' => 'Divisi tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data anggota divisi',
            'data' => $division->members->map(function ($member) {
                return [
                    'id_user' => $member->anggota_id,
                    'name' => $member->user->name ?? null,
                ];
            })
        ]);
    }

    // POST /divisions/{id}/members
    public function addMember(Request $request, $id)
    {
        $division = Division::find($id);

        if (!$division) {
            return response()->json([
                'success' => false,
                'message' => 'Divisi tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'anggota_id' => 'required|exists:users,id_user',
        ]);

        $exists = DivisionMember::where('division_id', $id)
            ->where('anggota_id', $request->anggota_id)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'User sudah menjadi anggota divisi ini'
            ], 409);
        }

        DivisionMember::create([
            'division_id' => $id,
            'anggota_id' => $request->anggota_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Anggota berhasil ditambahkan ke divisi',
        ], 201);
    }

    // DELETE /divisions/{id}/members/{id_user}
    public function removeMember($id, $id_user)
    {
        $division = Division::find($id);

        if (!$division) {
            return response()->json([
                'success' => false,
                'message' => 'Divisi tidak ditemukan'
            ], 404);
        }

        $member = DivisionMember::where('division_id', $id)
            ->where('anggota_id', $id_user)
            ->first();

        if (!$member) {
            return response()->json([
                'success' => false,
                'message' => 'Anggota tidak ditemukan di divisi ini'
            ], 404);
        }

        $member->delete();

        return response()->json([
            'success' => true,
            'message' => 'Anggota berhasil dihapus dari divisi'
        ]);
    }
}