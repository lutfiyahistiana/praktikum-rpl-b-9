<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function showTask()
    {
        $userId   = Auth::id();
        $allTasks = Task::where('assigned_to', $userId)->get();

        $totalTugas   = $allTasks->count();
        $totalSelesai = $allTasks->where('status', 'done')->count();
        $avgProgress  = $totalTugas > 0 ? round(($totalSelesai / $totalTugas) * 100) : 0;

        $tugasBelumSelesai = Task::where('assigned_to', $userId)
            ->whereIn('status', ['pending', 'in_progress'])
            ->orderBy('deadline')
            ->get();

        $tugasSelesai = Task::where('assigned_to', $userId)
            ->where('status', 'done')
            ->orderByDesc('updated_at')
            ->get();

        return view('anggota.taskList', [
            'title'             => 'Task',
            'menuTask'          => 'active',
            'tugasBelumSelesai' => $tugasBelumSelesai,
            'tugasSelesai'      => $tugasSelesai,
            'avgProgress'       => $avgProgress,
        ]);
    }

    public function show($id)
    {
        $task = Task::where('id_task', $id)
            ->with([
                'assigner',
                'progresses' => fn($q) => $q->latest()
            ])
            ->firstOrFail();

        return view('anggota.taskDetail', [
            'title'    => 'Detail Tugas',
            'menuTask' => 'active',
            'task'     => $task,
        ]);
    }

    public function storeProgress(Request $request, $id)
    {
        $userId = Auth::id();

        $request->validate([
            'notes'      => 'nullable|string|max:1000',
            'link_url'   => 'nullable|url|max:255',
            'file_tugas' => 'nullable|file|max:10240|mimes:pdf,doc,docx,zip,jpg,jpeg,png',
        ]);

        $task = Task::where('id_task', $id)
            ->where('assigned_to', $userId)
            ->firstOrFail();

        // Upload file kalau ada
        $filePath = null;
        if ($request->hasFile('file_tugas')) {
            $filePath = $request->file('file_tugas')->store('task-submissions', 'public');
        }

        TaskProgress::create([
            'task_id'    => $task->id_task,
            'user_id'    => $userId,
            'percentage' => 100,
            'notes'      => $request->notes,
            'file_path'  => $filePath,
            'link_url'   => $request->link_url,
        ]);

        // Update status task jadi selesai
        $task->update(['status' => 'done']);

        return redirect()->route('anggota_tim.task.detail', $id)
                         ->with('success', 'Tugas berhasil diselesaikan!');
    }
}