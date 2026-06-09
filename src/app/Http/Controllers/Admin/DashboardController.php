<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        $total_bab = \App\Models\Material::count();
        $total_file = \App\Models\MaterialFile::count();
        $total_tugas = \App\Models\Task::count();
        $total_tugas_selesai = \App\Models\Task::where('status', 'done')->count();
        $total_tugas_berjalan = \App\Models\Task::whereIn('status', ['pending', 'in_progress'])->where('deadline', '>=', now())->count();
        $total_tugas_terlambat = \App\Models\Task::whereIn('status', ['pending', 'in_progress'])->where('deadline', '<', now())->count();

        $statistics = [
            'Total BAB Ditambahkan' => $total_bab,
            'Total File Ditambahkan' => $total_file,
            'Total Tugas' => $total_tugas,
            'Total Tugas Selesai' => $total_tugas_selesai,
            'Total Tugas Berjalan' => $total_tugas_berjalan,
            'Total Tugas Terlambat' => $total_tugas_terlambat,
        ];

        // Get aggregated task progress per user
        $usersWithTasks = \App\Models\User::whereHas('assignedTasks')->with('assignedTasks')->get();
        $progressItems = [];
        foreach ($usersWithTasks as $user) {
            $totalUserTasks = $user->assignedTasks->count();
            $completedUserTasks = $user->assignedTasks->where('status', 'done')->count();
            $percentage = $totalUserTasks > 0 ? round(($completedUserTasks / $totalUserTasks) * 100) : 0;

            $progressItems[] = [
                'name' => $user->name,
                'progress' => $percentage,
            ];
        }

        // Sort by progress descending, or take top 6, etc. We can just take the first 6 for now.
        $progressItems = array_slice($progressItems, 0, 6);

        // Get pending tasks
        $pendingTasksData = \App\Models\Task::with('assignee')->whereIn('status', ['pending', 'in_progress'])->orderBy('deadline', 'asc')->take(5)->get();
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
        return view('admin.dashboard', $data);
    }
}
