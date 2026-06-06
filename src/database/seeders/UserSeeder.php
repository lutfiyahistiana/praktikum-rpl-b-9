<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;

// class UserSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      */
//     public function run(): void
//     {
//         $user = User::create([
//             'name' => 'Superadmin 1',
//             'email' => 'superadmin1@gmail.com',
//             'password' => Hash::make('12345678'),
//             'created_by' => null,
//         ]);

//         UserRole::create([
//             'id_user' => $user->id_user,
//             'id_role' => 1, //id superadmin
//         ]);
//     }
// }

// <?php

// namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;
// use App\Models\User;
// use App\Models\UserRole;
// use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // A: superadmin1 dapat semua role (superadmin, admin, ketua_tim, pelatih, anggota_tim)
        $superadmin = User::create([
            'name'       => 'Superadmin 1',
            'email'      => 'superadmin1@gmail.com',
            'password'   => Hash::make('12345678'),
            'created_by' => null,
        ]);

        foreach ([1, 2, 3, 4, 5] as $roleId) {
            UserRole::create([
                'id_user' => $superadmin->id_user,
                'id_role' => $roleId,
            ]);
        }

        // B: admin1, role ketua_tim & pelatih
        $admin = User::create([
            'name'       => 'Admin 1',
            'email'      => 'admin1@gmail.com',
            'password'   => Hash::make('admin1234567'),
            'created_by' => $superadmin->id_user,
        ]);

        foreach ([3, 4] as $roleId) {
            UserRole::create([
                'id_user' => $admin->id_user,
                'id_role' => $roleId,
            ]);
        }

        // C: shafa, role anggota_tim & ketua_tim
        $shafa = User::create([
            'name'       => 'Shafa Rifkika Nur Fauziah',
            'email'      => 'shafafauziah33@gmail.com',
            'password'   => Hash::make('shafarifkika123'),
            'created_by' => $superadmin->id_user,
        ]);

        foreach ([5, 3] as $roleId) {
            UserRole::create([
                'id_user' => $shafa->id_user,
                'id_role' => $roleId,
            ]);
        }

        // D: anggota1, role anggota_tim
        $anggota = [
            ['name' => 'Muhammad Ihza Dzikrullah', 'email' => 'unihza@gmail.com',          'password' => 'muhihza123'],
            ['name' => 'Rafli Ahmad',              'email' => 'ahmadraplyy@gmail.com',      'password' => 'rafliahmad123'],
            ['name' => 'Lutfiyah Istiana',         'email' => 'lutfiyahistiana@gmail.com',  'password' => 'lutfiyah123'],
];

        foreach ($anggota as $data) {
            $user = User::create([
                'name'       => $data['name'],
                'email'      => $data['email'],
                'password'   => Hash::make($data['password']),
                'created_by' => $superadmin->id_user,
            ]);

            UserRole::create([
                'id_user' => $user->id_user,
                'id_role' => 5, // anggota_tim
            ]);
        }
    }
}