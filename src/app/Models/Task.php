<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $table = 'task';
    protected $primaryKey = 'id_task';

    protected $fillable = [
        'title',
        'description',
        'assigned_to',
        'assigned_by',
        'deadline',
        'status',
        'attachment_file',
        'attachment_link',
    ];

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id_user');
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by', 'id_user');
    }

    // Alias untuk assignedTo — dipakai di beberapa controller
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id_user');
    }

    // Alias untuk assignedBy — dipakai di view anggota
    public function assigner()
    {
        return $this->belongsTo(User::class, 'assigned_by', 'id_user');
    }

    // Relasi ke TaskProgress
    public function progresses()
    {
        return $this->hasMany(TaskProgress::class, 'task_id', 'id_task');
    }
}
