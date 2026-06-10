<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    // GET /tasks 
    public function index()
    {
        $tasks = Task::all();

        foreach ($tasks as $task) {
            if (in_array($task->status, ['pending', 'in_progress']) && now()->gt($task->deadline)) {
                $task->update(['status' => 'in_progress']);
            }
        }

        return response()->json([
            'success' => true,
            'data'    => $tasks->fresh(),
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
    public function show($id)
    {
        $task = Task::findOrFail($id);

        // Cek otomatis terlambat
        if (in_array($task->status, ['pending', 'in_progress']) && now()->gt($task->deadline)) {
            $task->update(['status' => 'in_progress']);
        }

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