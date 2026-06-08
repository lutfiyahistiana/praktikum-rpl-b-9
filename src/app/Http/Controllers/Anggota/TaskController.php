<?php

namespace App\Http\Controllers\Anggota;

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
        return view('anggota.taskList', $data);
    }
}
