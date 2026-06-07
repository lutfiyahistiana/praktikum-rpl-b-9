<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Superadmin 1',
            'email' => 'superadmin1@gmail.com',
            'password' => Hash::make('12345678'),
            'created_by' => null,
        ]);

        UserRole::create([
            'id_user' => $user->id_user,
            'id_role' => 1, //id superadmin
        ]);
    }
}
