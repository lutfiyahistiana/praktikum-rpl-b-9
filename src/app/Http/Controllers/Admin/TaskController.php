<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function showTask()
    {
        $data = array(
            'title'    => 'Task',
            'menuTask' => 'active'
        );
        return view('admin.taskList', $data);
    }
}
