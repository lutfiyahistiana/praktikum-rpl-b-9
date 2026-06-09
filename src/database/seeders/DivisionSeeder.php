<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Division;
use App\Models\DivisionMember;

class DivisionSeeder extends Seeder
{
    public function run(): void
    {
        // Programming — anggota anggota_id 3 (Shafa), sekaligus ketua
        $programming = Division::create([
            'division_name'      => 'Programming',
            'ketua_division_id'  => 3,
        ]);

        DivisionMember::create([
            'anggota_id' => 3,
            'division_id' => $programming->id_division,
        ]);

        // Electronics — anggota anggota_id 4 (Ihza), sekaligus ketua
        $electronics = Division::create([
            'division_name'      => 'Electronics',
            'ketua_division_id'  => 4,
        ]);

        DivisionMember::create([
            'anggota_id' => 4,
            'division_id' => $electronics->id_division,
        ]);

        // Manufacturing — anggota anggota_id 5 (Rafli), sekaligus ketua
        $manufacturing = Division::create([
            'division_name'      => 'Manufacturing',
            'ketua_division_id'  => 5,
        ]);

        DivisionMember::create([
            'anggota_id' => 5,
            'division_id' => $manufacturing->id_division,
        ]);
    }
}