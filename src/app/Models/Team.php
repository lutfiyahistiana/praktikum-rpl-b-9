<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'teams';
    protected $primaryKey = 'id_team';
    protected $fillable = ['team_name', 'ketua_team_id'];

    public function ketua()
    {
        return $this->belongsTo(User::class, 'ketua_team_id', 'id_user');
    }

    public function members()
    {
        return $this->hasMany(TeamMember::class, 'team_id', 'id_team');
    }
}