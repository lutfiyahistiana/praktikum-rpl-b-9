<?php

namespace App\Http\Controllers\KetuaTim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function showTask()
    {
        $user_id = auth()->id();
        $team = \App\Models\Team::where('ketua_team_id', $user_id)->first();
        $memberIds = $team ? $team->members()->pluck('anggota_id')->toArray() : [];
        $relevantUserIds = array_unique(array_merge([$user_id], $memberIds));

        $tasksQuery = \App\Models\Task::with(['assignee'])->whereIn('assigned_to', $relevantUserIds)->orWhere('assigned_by', $user_id);
        
        $unfinishedTasksData = (clone $tasksQuery)->whereIn('status', ['pending', 'in_progress'])->get();
        $finishedTasksData = (clone $tasksQuery)->where('status', 'done')->get();

        $unfinishedTasks = [];
        foreach ($unfinishedTasksData as $task) {
            $statusStr = ($task->deadline && $task->deadline < now()) ? 'Terlambat' : 'Berjalan';
            
            $unfinishedTasks[] = [
                'title' => $task->title,
                'receiver' => $task->assignee ? $task->assignee->name : 'Tidak ada',
                'status' => $statusStr,
                'deadline' => $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('j M Y') : 'Tanpa Deadline',
            ];
        }

        $finishedTasks = [];
        foreach ($finishedTasksData as $task) {
            $statusStr = ($task->deadline && $task->deadline < now()) ? 'Terlambat' : 'Berjalan'; // Though it's finished, maybe it was late? The view says 'Terlambat' or 'Berjalan' even for finished tasks? Wait, let's just keep it like unfinished for the view variables.

            $finishedTasks[] = [
                'title' => $task->title,
                'receiver' => $task->assignee ? $task->assignee->name : 'Tidak ada',
                'status' => $statusStr,
                'deadline' => $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('j M Y') : 'Tanpa Deadline',
            ];
        }

        $data = [
            'title'    => 'Task',
            'menuTask' => 'active',
            'unfinishedTasks' => $unfinishedTasks,
            'finishedTasks' => $finishedTasks,
        ];
        return view('ketuaTim.taskList', $data);
    }

    public function show($id)
    {
        $data = [
            'title'    => 'Detail Tugas',
            'menuTask' => 'active',
            'id'       => $id,
        ];
        return view('ketuaTim.taskDetail', $data);
    }

    public function tambah()
    {
        $data = [
            'title'    => 'Tambah Tugas',
            'menuTask' => 'active',
        ];
        return view('ketuaTim.taskDetail', $data);
    }

    public function store(\Illuminate\Http\Request $request)
    {
        // 1. Validasi Input Dasar
        $request->validate([
            'judul_tugas' => 'required',
            'ditugaskan_kepada' => 'required|email',
            'deskripsi_tugas' => 'required',
            'tenggat_waktu' => 'required|date'
        ]);

        // 2. Cari ID User Penerima berdasarkan Email
        $assignee = \App\Models\User::where('email', $request->ditugaskan_kepada)->first();
        if (!$assignee) {
            return redirect()->back()->withErrors(['ditugaskan_kepada' => 'Email pengguna tidak ditemukan di sistem.'])->withInput();
        }

        // 3. Simpan ke database
        \App\Models\Task::create([
            'title' => $request->judul_tugas,
            'description' => $request->deskripsi_tugas,
            'assigned_to' => $assignee->id_user,
            'assigned_by' => auth()->user()->id_user,
            'deadline' => $request->tenggat_waktu,
            'status' => 'pending'
        ]);
        
        // 4. Redirect kembali dengan pesan sukses
        return redirect()->route('ketua_tim.task.tambah')->with('success', 'Tugas berhasil ditambahkan!');
    }
}
