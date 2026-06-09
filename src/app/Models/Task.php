<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'task';

    protected $primaryKey = 'id_task';

    protected $fillable = [
        'title',
        'description',
        'assigned_to',
        'assigned_by',
        'deadline',
        'status'
    ];

    public function assignee()
    {
        return $this->belongsTo(
            User::class,
            'assigned_to',
            'id_user'
        );
    }

    public function assigner()
    {
        return $this->belongsTo(
            User::class,
            'assigned_by',
            'id_user'
        );
    }

    public function progresses()
    {
        return $this->hasMany(
            TaskProgress::class,
            'task_id',
            'id_task'
        );
    }
}