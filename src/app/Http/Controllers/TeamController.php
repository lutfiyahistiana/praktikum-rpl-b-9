<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    // GET /teams
    public function index()
    {
        $teams = Team::with('ketua')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data tim berhasil diambil',
            'data' => $teams->map(function ($team) {
                return [
                    'id_team' => $team->id_team,
                    'team_name' => $team->team_name,
                    'ketua_team_id' => $team->ketua_team_id,
                    'ketua_name' => $team->ketua->name ?? null,
                ];
            })
        ]);
    }

    // GET /teams/{id}
    public function show($id)
    {
        $team = Team::with('ketua', 'members.user')->find($id);

        if (!$team) {
            return response()->json([
                'success' => false,
                'message' => 'Tim tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data tim berhasil diambil',
            'data' => [
                'id_team' => $team->id_team,
                'team_name' => $team->team_name,
                'ketua_team_id' => $team->ketua_team_id,
                'ketua_name' => $team->ketua->name ?? null,
                'members' => $team->members->map(function ($member) {
                    return [
                        'id_user' => $member->anggota_id,
                        'name' => $member->user->name ?? null,
                    ];
                }),
            ]
        ]);
    }

    // POST /teams
    public function store(Request $request)
    {
        $request->validate([
            'team_name' => 'required|string',
            'ketua_team_id' => 'required|exists:users,id_user',
        ]);

        $team = Team::create([
            'team_name' => $request->team_name,
            'ketua_team_id' => $request->ketua_team_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tim berhasil dibuat',
            'data' => [
                'id_team' => $team->id_team,
                'team_name' => $team->team_name,
                'ketua_team_id' => $team->ketua_team_id,
            ]
        ], 201);
    }

    // PUT /teams/{id}
    public function update(Request $request, $id)
    {
        $team = Team::find($id);

        if (!$team) {
            return response()->json([
                'success' => false,
                'message' => 'Tim tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'team_name' => 'sometimes|string',
            'ketua_team_id' => 'sometimes|exists:users,id_user',
        ]);

        if ($request->has('team_name')) $team->team_name = $request->team_name;
        if ($request->has('ketua_team_id')) $team->ketua_team_id = $request->ketua_team_id;

        $team->save();

        return response()->json([
            'success' => true,
            'message' => 'Tim berhasil diupdate',
            'data' => [
                'id_team' => $team->id_team,
                'team_name' => $team->team_name,
                'ketua_team_id' => $team->ketua_team_id,
            ]
        ]);
    }

    // DELETE /teams/{id}
    public function destroy($id)
    {
        $team = Team::find($id);

        if (!$team) {
            return response()->json([
                'success' => false,
                'message' => 'Tim tidak ditemukan'
            ], 404);
        }

        $team->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tim berhasil dihapus'
        ]);
    }

    // GET /teams/{id}/members
    public function getMembers($id)
    {
        $team = Team::with('members.user')->find($id);

        if (!$team) {
            return response()->json([
                'success' => false,
                'message' => 'Tim tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data anggota tim',
            'data' => $team->members->map(function ($member) {
                return [
                    'id_user' => $member->anggota_id,
                    'name' => $member->user->name ?? null,
                ];
            })
        ]);
    }

    // POST /teams/{id}/members
    public function addMember(Request $request, $id)
    {
        $team = Team::find($id);

        if (!$team) {
            return response()->json([
                'success' => false,
                'message' => 'Tim tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'anggota_id' => 'required|exists:users,id_user',
        ]);

        $exists = TeamMember::where('team_id', $id)
            ->where('anggota_id', $request->anggota_id)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'User sudah menjadi anggota tim ini'
            ], 409);
        }

        TeamMember::create([
            'team_id' => $id,
            'anggota_id' => $request->anggota_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Anggota berhasil ditambahkan',
        ], 201);
    }

    // DELETE /teams/{id}/members/{id_user}
    public function removeMember($id, $id_user)
    {
        $team = Team::find($id);

        if (!$team) {
            return response()->json([
                'success' => false,
                'message' => 'Tim tidak ditemukan'
            ], 404);
        }

        $member = TeamMember::where('team_id', $id)
            ->where('anggota_id', $id_user)
            ->first();

        if (!$member) {
            return response()->json([
                'success' => false,
                'message' => 'Anggota tidak ditemukan di tim ini'
            ], 404);
        }

        $member->delete();

        return response()->json([
            'success' => true,
            'message' => 'Anggota berhasil dihapus dari tim'
        ]);
    }
}