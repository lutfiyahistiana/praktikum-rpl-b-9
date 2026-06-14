<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function showTask()
    {
        $unfinishedTasksData = \App\Models\Task::with(['assignee'])->whereIn('status', ['pending', 'in_progress'])->get();
        $finishedTasksData = \App\Models\Task::with(['assignee'])->where('status', 'done')->get();

        $unfinishedTasks = [];
        foreach ($unfinishedTasksData as $task) {
            $statusStr = ($task->deadline && $task->deadline < now()) ? 'Terlambat' : 'Berjalan';
            
            // Get team from teamMembers if exists
            $teamName = 'Tidak ada Tim';
            $teamMember = \App\Models\TeamMember::with('team')->where('anggota_id', $task->assigned_to)->first();
            if ($teamMember && $teamMember->team) {
                $teamName = $teamMember->team->team_name;
            }

            $unfinishedTasks[] = [
                'title' => $task->title,
                'receiver' => $task->assignee ? $task->assignee->name : 'Tidak ada',
                'team' => $teamName,
                'status' => $statusStr,
                'deadline' => $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('j M Y') : 'Tanpa Deadline',
            ];
        }

        $finishedTasks = [];
        foreach ($finishedTasksData as $task) {
            $teamName = 'Tidak ada Tim';
            $teamMember = \App\Models\TeamMember::with('team')->where('anggota_id', $task->assigned_to)->first();
            if ($teamMember && $teamMember->team) {
                $teamName = $teamMember->team->team_name;
            }

            $finishedTasks[] = [
                'title' => $task->title,
                'receiver' => $task->assignee ? $task->assignee->name : 'Tidak ada',
                'team' => $teamName,
                'finished_at' => $task->updated_at ? \Carbon\Carbon::parse($task->updated_at)->format('j M Y') : 'Selesai',
            ];
        }

        $data = array(
            'title'    => 'Task',
            'menuTask' => 'active',
            'unfinishedTasks' => $unfinishedTasks,
            'finishedTasks' => $finishedTasks,
        );
        return view('admin.taskList', $data);
    }

    public function show($id)
    {
        $task = \App\Models\Task::with(['assignee', 'assigner'])->findOrFail($id);

        $teamName = 'Tidak ada Tim';
        $teamMember = \App\Models\TeamMember::with('team')->where('anggota_id', $task->assigned_to)->first();
        if ($teamMember && $teamMember->team) {
            $teamName = $teamMember->team->team_name;
        }

        $data = [
            'title'    => 'Detail Tugas',
            'menuTask' => 'active',
            'task'     => $task,
            'teamName' => $teamName,
        ];
        return view('admin.taskDetail', $data);
    }
}
