<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function showTask()
    {
        $data = array(
            'title'    => 'Task',
            'menuTask' => 'active'
        );
        return view('task.anggota', $data);
    }
}
