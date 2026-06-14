<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskProgressController extends Controller
{
    // GET /progress — persentase progress semua anggota
    public function index()
    {
        $users = \App\Models\User::with('roles')
            ->whereHas('roles', fn($q) => $q->where('role_name', 'anggota_tim'))
            ->get();

        $result = $users->map(function ($user) {
            $total    = Task::where('assigned_to', $user->id_user)->count();
            $selesai  = Task::where('assigned_to', $user->id_user)
                            ->where('status', 'done')
                            ->count();
            $persentase = $total > 0 ? round(($selesai / $total) * 100, 2) : 0;

            return [
                'id_user'     => $user->id_user,
                'name'        => $user->name,
                'total_tugas' => $total,
                'selesai'     => $selesai,
                'persentase'  => $persentase,
            ];
        });

        return response()->json([
            'success' => true,
            'data'    => $result,
        ]);
    }

    // GET /progress/{id_user} — persentase progress 1 anggota
    public function show($id_user)
    {
        $user = \App\Models\User::findOrFail($id_user);

        $total   = Task::where('assigned_to', $id_user)->count();
        $selesai = Task::where('assigned_to', $id_user)
                       ->where('status', 'done')
                       ->count();
        $persentase = $total > 0 ? round(($selesai / $total) * 100, 2) : 0;

        $tasks = Task::where('assigned_to', $id_user)
                     ->select('id_task', 'title', 'status', 'deadline')
                     ->get();

        return response()->json([
            'success' => true,
            'data'    => [
                'id_user'     => $user->id_user,
                'name'        => $user->name,
                'total_tugas' => $total,
                'selesai'     => $selesai,
                'persentase'  => $persentase,
                'tasks'       => $tasks,
            ],
        ]);
    }
}