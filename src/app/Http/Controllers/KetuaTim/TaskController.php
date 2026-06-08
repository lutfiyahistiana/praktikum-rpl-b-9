<?php

namespace App\Http\Controllers\KetuaTim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function showTask()
    {
        $data = [
            'title'    => 'Task',
            'menuTask' => 'active',
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
}
