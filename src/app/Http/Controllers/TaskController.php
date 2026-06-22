<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    private function addStatusLabel(Task $task): Task
    {
        if ($task->status === 'done') {
            $task->status_label = 'Selesai';
        } elseif (in_array($task->status, ['pending', 'in_progress']) && $task->deadline && now()->gt($task->deadline)) {
            $task->status_label = 'Terlambat';
            $task->is_overdue = true;
        } elseif ($task->status === 'in_progress') {
            $task->status_label = 'Sedang Dikerjakan';
            $task->is_overdue = false;
        } else {
            $task->status_label = 'Belum Dikerjakan';
            $task->is_overdue = false;
        }
        return $task;
    }

    // GET /tasks 
    public function index(Request $request)
    {
        $user = $request->user();
        $userRoles = $user->roles->pluck('role_name')->toArray();

        if (in_array('anggota_tim', $userRoles) && !in_array('admin', $userRoles) && !in_array('superadmin', $userRoles) && !in_array('ketua_tim', $userRoles)) {
            $tasks = Task::where('assigned_to', $user->id_user)->get();
        } else {
            $tasks = Task::all();
        }

        $tasks->each(fn($task) => $this->addStatusLabel($task));

        return response()->json([
            'success' => true,
            'data'    => $tasks,
        ]);
    }

    // POST /tasks
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string',
            'description' => 'nullable|string',
            'assigned_to' => 'required|exists:users,id_user',
            'deadline'    => 'required|date',
        ]);

        $task = Task::create([
            'title'       => $request->title,
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
            'assigned_by' => $request->user()->id_user,
            'deadline'    => $request->deadline,
            'status'      => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Task berhasil dibuat',
            'data'    => $task,
        ], 201);
    }

    // PUT /tasks/{id}
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,in_progress,done',
        ]);

        // Cek deadline saat mau selesaikan
        if ($request->status === 'done' && now()->gt($task->deadline)) {
            $task->update(['status' => 'done']);
            return response()->json([
                'success' => true,
                'message' => 'Task selesai meski deadline terlewat',
                'data'    => $task,
            ]);
        }

        $task->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status task berhasil diupdate',
            'data'    => $task,
        ]);
    }

    // GET /tasks/{id} — detail task
    public function show(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $user = $request->user();
        $userRoles = $user->roles->pluck('role_name')->toArray();

        if (in_array('anggota_tim', $userRoles) && !in_array('admin', $userRoles) && !in_array('superadmin', $userRoles) && !in_array('ketua_tim', $userRoles)) {
            if ($task->assigned_to !== $user->id_user) {
                return response()->json(['message' => 'Anda tidak memiliki akses ke tugas ini.'], 403);
            }
        }

        // Cek otomatis terlambat
        $this->addStatusLabel($task);

        return response()->json([
            'success' => true,
            'data'    => $task,
        ]);
    }

    // DELETE /tasks/{id} — hapus task
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task berhasil dihapus',
        ]);
    }
}