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

        $tasksQuery = \App\Models\Task::with(['assignee'])->where(function ($query) use ($relevantUserIds, $user_id) {
            $query->whereIn('assigned_to', $relevantUserIds)
                  ->orWhere('assigned_by', $user_id);
        });
        
        $unfinishedTasksData = (clone $tasksQuery)->whereIn('status', ['pending', 'in_progress'])->get();
        $finishedTasksData = (clone $tasksQuery)->where('status', 'done')->get();

        $unfinishedTasks = [];
        foreach ($unfinishedTasksData as $task) {
            $statusStr = ($task->deadline && $task->deadline < now()) ? 'Terlambat' : 'Berjalan';
            
            $unfinishedTasks[] = [
                'id'       => $task->id_task,
                'title'    => $task->title,
                'receiver' => $task->assignee ? $task->assignee->name : 'Tidak ada',
                'status'   => $statusStr,
                'deadline' => $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('j M Y') : 'Tanpa Deadline',
            ];
        }

        $finishedTasks = [];
        foreach ($finishedTasksData as $task) {
            $statusStr = ($task->deadline && $task->updated_at && $task->updated_at > $task->deadline) ? 'Selesai (Terlambat)' : 'Selesai';

            $finishedTasks[] = [
                'id'       => $task->id_task,
                'title'    => $task->title,
                'receiver' => $task->assignee ? $task->assignee->name : 'Tidak ada',
                'status'   => $statusStr,
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
        $attachmentPath = null;
        if ($request->hasFile('lampiran_file')) {
            $attachmentPath = \App\Helpers\StorageHelper::store($request->file('lampiran_file'), 'task-attachments');
        }

        \App\Models\Task::create([
            'title'           => $request->judul_tugas,
            'description'     => $request->deskripsi_tugas,
            'assigned_to'     => $assignee->id_user,
            'assigned_by'     => auth()->user()->id_user,
            'deadline'        => $request->tenggat_waktu,
            'status'          => 'pending',
            'attachment_file' => $attachmentPath,
            'attachment_link' => $request->lampiran_link ?: null,
        ]);
        
        // 4. Redirect kembali dengan pesan sukses
        return redirect()->route('ketua_tim.task.tambah')->with('success', 'Tugas berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $task = \App\Models\Task::findOrFail($id);
        
        if ($task->assigned_by !== auth()->user()->id_user) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menghapus tugas ini.');
        }

        $task->delete();
        return redirect()->route('ketua_tim.task')->with('success', 'Tugas berhasil dihapus.');
    }

    public function revertStatus($id)
    {
        $task = \App\Models\Task::findOrFail($id);

        if ($task->assigned_by !== auth()->user()->id_user) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengubah tugas ini.');
        }

        if ($task->status === 'done') {
            $task->update(['status' => 'in_progress']);
            return redirect()->route('ketua_tim.task')->with('success', 'Status tugas berhasil dikembalikan.');
        }

        return redirect()->back()->with('error', 'Tugas ini belum selesai.');
    }
}
