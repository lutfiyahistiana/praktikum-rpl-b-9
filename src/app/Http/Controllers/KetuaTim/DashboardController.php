<?php

namespace App\Http\Controllers\KetuaTim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        $user_id = auth()->id();
        $team = \App\Models\Team::where('ketua_team_id', $user_id)->first();
        $memberIds = $team ? $team->members()->pluck('anggota_id')->toArray() : [];
        $relevantUserIds = array_unique(array_merge([$user_id], $memberIds));

        $tasksQuery = \App\Models\Task::where(function($q) use ($relevantUserIds, $user_id) {
            $q->whereIn('assigned_to', $relevantUserIds)->orWhere('assigned_by', $user_id);
        });
        
        $total_tugas = (clone $tasksQuery)->count();
        $total_tugas_selesai = (clone $tasksQuery)->where('status', 'done')->count();
        $total_tugas_berjalan = (clone $tasksQuery)->whereIn('status', ['pending', 'in_progress'])->where('deadline', '>=', now())->count();
        $total_tugas_terlambat = (clone $tasksQuery)->whereIn('status', ['pending', 'in_progress'])->where('deadline', '<', now())->count();

        $statistics = [
            'Total Tugas' => $total_tugas,
            'Total Tugas Selesai' => $total_tugas_selesai,
            'Total Tugas Berjalan' => $total_tugas_berjalan,
            'Total Tugas Terlambat' => $total_tugas_terlambat,
        ];

        // Get all unique users who are either in the team, or have tasks assigned to them by this leader, or the leader themselves
        $assignedToUserIds = \App\Models\Task::where('assigned_by', $user_id)->pluck('assigned_to')->toArray();
        $allProgressUserIds = array_unique(array_merge($relevantUserIds, $assignedToUserIds));

        $progressItems = [];
        if (!empty($allProgressUserIds)) {
            $members = \App\Models\User::whereIn('id_user', $allProgressUserIds)->whereHas('assignedTasks')->with('assignedTasks')->get();
            foreach ($members as $member) {
                $totalUserTasks = $member->assignedTasks->count();
                $completedUserTasks = $member->assignedTasks->where('status', 'done')->count();
                $percentage = $totalUserTasks > 0 ? round(($completedUserTasks / $totalUserTasks) * 100) : 0;

                $progressItems[] = [
                    'name' => $member->name,
                    'progress' => $percentage,
                ];
            }
        }

        // Get pending tasks
        $pendingTasksData = (clone $tasksQuery)->with('assignee')->whereIn('status', ['pending', 'in_progress'])->orderBy('deadline', 'asc')->take(5)->get();
        $pendingTasks = [];
        foreach ($pendingTasksData as $task) {
            $statusStr = ($task->deadline && $task->deadline < now()) ? 'Terlambat' : 'Berjalan';
            $pendingTasks[] = [
                'title' => $task->title,
                'status' => $statusStr,
                'assignee' => $task->assignee ? $task->assignee->name : 'No Assignee',
                'deadline' => $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('j M Y') : 'Tanpa Deadline',
            ];
        }

        $data = array(
            'title'         => 'Dashboard',
            'menuDashboard' => 'active',
            'statistics'    => $statistics,
            'progressItems' => $progressItems,
            'pendingTasks'  => $pendingTasks,
        );
        return view('ketuaTim.dashboard', $data);
    }
}
