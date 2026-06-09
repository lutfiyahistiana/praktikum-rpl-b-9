<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskProgress extends Model
{
    protected $table = 'task_progress';
    protected $primaryKey = 'id_task_progress';
    protected $fillable = [
        'task_id',
        'user_id',
        'notes',
        'percentage',
        'file_path',
        'link_url',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id', 'id_task');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }
}