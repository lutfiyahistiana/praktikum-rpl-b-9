<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $table = 'divisions';
    protected $primaryKey = 'id_division';
    protected $fillable = ['division_name', 'ketua_division_id'];

    public function ketua()
    {
        return $this->belongsTo(User::class, 'ketua_division_id', 'id_user');
    }

    public function members()
    {
        return $this->hasMany(DivisionMember::class, 'division_id', 'id_division');
    }
}