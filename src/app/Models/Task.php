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
    ];

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id_user');
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by', 'id_user');
    }
}
