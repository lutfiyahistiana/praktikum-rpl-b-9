<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'users';

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'name',
        'nim',
        'email',
        'password',
        'created_by',
        'prodi',
        'fakultas',
        'no_hp',
        'username_github',
        'photo',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            //
        ];
    }

    //Relasi model

    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'user_roles',
            'id_user',
            'id_role'
        );
    }

    //RELASI USER YANG MEMBUAT AKUN

    public function creator()
    {
        return $this->belongsTo(
            User::class,
            'created_by',
            'id_user'
        );
    }

    public function createdUsers()
    {
        return $this->hasMany(
            User::class,
            'created_by',
            'id_user'
        );
    }

   //relasi task

    public function assignedTasks()
    {
        return $this->hasMany(
            Task::class,
            'assigned_to',
            'id_user'
        );
    }

    public function createdTasks()
    {
        return $this->hasMany(
            Task::class,
            'assigned_by',
            'id_user'
        );
    }

  //relasi task progress

    public function taskProgresses()
    {
        return $this->hasMany(
            TaskProgress::class,
            'user_id',
            'id_user'
        );
    }

 //RELASI MATERIAL

    public function uploadedMaterials()
    {
        return $this->hasMany(
            Material::class,
            'uploaded_by',
            'id_user'
        );
    }
}