<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DivisionMember extends Model
{
    protected $table = 'divisions_members';
    protected $primaryKey = 'id_division_member';
    protected $fillable = ['division_id', 'anggota_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'anggota_id', 'id_user');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id_division');
    }
}