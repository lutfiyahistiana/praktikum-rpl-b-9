<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\TeamMember;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        // Sambergeni
        $sambergeni = Team::create([
            'team_name' => 'Sambergeni',
            'ketua_team_id' => 5,
        ]);

        TeamMember::create([
            'anggota_id' => 3,
            'team_id' => $sambergeni->id_team,
        ]);

        // Sriwedari
        $sriwedari = Team::create([
            'team_name' => 'Sriwedari',
            'ketua_team_id' => 4,
        ]);

        TeamMember::create([
            'anggota_id' => 4,
            'team_id' => $sriwedari->id_team,
        ]);

        // Werkudara
        $werkudara = Team::create([
            'team_name' => 'Werkudara',
            'ketua_team_id' => 3,
        ]);

        foreach ([5, 6] as $userId) {
            TeamMember::create([
                'anggota_id' => $userId,
                'team_id' => $werkudara->id_team,
            ]);
        }
    }
}