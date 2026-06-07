<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $table = 'teams_members';
    protected $primaryKey = 'id_team_member';
    protected $fillable = ['team_id', 'anggota_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'anggota_id', 'id_user');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id_team');
    }
}