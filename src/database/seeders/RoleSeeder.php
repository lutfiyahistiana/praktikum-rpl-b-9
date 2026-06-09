<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            ['role_name' => 'superadmin'],
            ['role_name' => 'admin'],
            ['role_name' => 'ketua_tim'],
            ['role_name' => 'pelatih'],
            ['role_name' => 'anggota_tim'],
        ]);
    }
}
