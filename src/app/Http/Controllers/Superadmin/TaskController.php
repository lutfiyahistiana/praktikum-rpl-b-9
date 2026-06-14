<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Task;

class TaskController extends Controller
{
    public function showTask()
    {
        $pendingTasks = Task::with('assignedTo')->where('status', '!=', 'done')->get();
        $doneTasks = Task::with('assignedTo')->where('status', 'done')->get();

        $data = array(
            'title'        => 'Task',
            'menuTask'     => 'active',
            'pendingTasks' => $pendingTasks,
            'doneTasks'    => $doneTasks
        );
        return view('superadmin.taskList', $data);
    }

    public function show($id)
    {
        $task = Task::with(['assignedTo'])->findOrFail($id);

        $data = [
            'title'    => 'Detail Tugas',
            'menuTask' => 'active',
            'task'     => $task,
        ];
        return view('superadmin.taskDetail', $data);
    }
}
