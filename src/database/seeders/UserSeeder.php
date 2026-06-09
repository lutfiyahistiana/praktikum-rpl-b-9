<?php

namespace Database\Seeders;

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
        // SUPERADMIN
        $superadmin = User::create([
            'name' => 'Superadmin 1',
            'nim' => 'L0124000',
            'email' => 'superadmin1@gmail.com',
            'password' => Hash::make('12345678'),
            'prodi' => 'Informatika',
            'fakultas' => 'Fakultas Teknologi Informasi dan Sains Data ',
            'no_hp' => '088227906220',
            'username_github' => '-',
            'created_by' => null,
        ]);

        foreach ([1, 2, 3, 4, 5] as $roleId) {
            UserRole::create([
                'id_user' => $superadmin->id_user,
                'id_role' => $roleId,
            ]);
        }

        // ADMIN
        $admin = User::create([
            'name' => 'Admin 1',
            'nim' => 'L0224000',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('admin1234567'),
            'prodi' => 'Informatika',
            'fakultas' => 'Fakultas Teknologi Informasi dan Sains Data ',
            'no_hp' => '088227906220',
            'username_github' => '-',
            'created_by' => $superadmin->id_user,
        ]);

        foreach ([3, 4] as $roleId) {
            UserRole::create([
                'id_user' => $admin->id_user,
                'id_role' => $roleId,
            ]);
        }

        // SHAFA
        $shafa = User::create([
            'name' => 'Shafa Rifkika Nur Fauziah',
            'nim' => 'L0124031',
            'email' => 'shafafauziah33@gmail.com',
            'password' => Hash::make('shafarifkika123'),
            'prodi' => 'Informatika',
            'fakultas' => 'Fakultas Teknologi Informasi dan Sains Data ',
            'no_hp' => '088227906220',
            'username_github' => 'shafarifkika',
            'created_by' => $superadmin->id_user,
        ]);

        foreach ([5, 3] as $roleId) {
            UserRole::create([
                'id_user' => $shafa->id_user,
                'id_role' => $roleId,
            ]);
        }

        // MUHAMMAD IHZA DZIKRULLAH
        $ihza = User::create([
            'name' => 'Muhammad Ihza Dzikrullah',
            'nim' => 'L0124024',
            'email' => 'unihza@gmail.com',
            'password' => Hash::make('muhihza123'),
            'prodi' => 'Informatika',
            'fakultas' => 'Fakultas Teknologi Informasi dan Sains Data ',
            'no_hp' => '081548914418',
            'username_github' => 'Frenchfrles',
            'created_by' => $superadmin->id_user,
        ]);

        UserRole::create([
            'id_user' => $ihza->id_user,
            'id_role' => 5,
        ]);

        // RAFLI
        $rafli = User::create([
            'name' => 'Rafli Ahmad',
            'nim' => 'L0124030',
            'email' => 'ahmadraplyy@gmail.com',
            'password' => Hash::make('rafliahmad123'),
            'prodi' => 'Informatika',
            'fakultas' => 'Fakultas Teknologi Informasi dan Sains Data ',
            'no_hp' => '081216210128',
            'username_github' => 'Rafli-Program',
            'created_by' => $superadmin->id_user,
        ]);

        UserRole::create([
            'id_user' => $rafli->id_user,
            'id_role' => 5,
        ]);

        // LUTFIYAH
        $lutfiyah = User::create([
            'name' => 'Lutfiyah Istiana',
            'nim' => 'L0124022',
            'email' => 'lutfiyahistiana@gmail.com',
            'password' => Hash::make('lutfiyah123'),
            'prodi' => 'Informatika',
            'fakultas' => 'Fakultas Teknologi Informasi dan Sains Data ',
            'no_hp' => '081935920710',
            'username_github' => 'lutfiyahistiana',
            'created_by' => $superadmin->id_user,
        ]);

        foreach ([1, 2, 3, 4, 5] as $roleId) {
            UserRole::create([
                'id_user' => $lutfiyah->id_user,
                'id_role' => $roleId,
            ]);
        }
    }
}