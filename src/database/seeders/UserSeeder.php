<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // SUPERADMIN
        $superadmin = User::firstOrCreate(
            ['email' => 'superadmin1@gmail.com'],
            [
                'name'            => 'Superadmin 1',
                'nim'             => 'L0124000',
                'password'        => Hash::make('12345678'),
                'prodi'           => 'Informatika',
                'fakultas'        => 'Fakultas Teknologi Informasi dan Sains Data',
                'no_hp'           => '088227906220',
                'username_github' => '-',
                'created_by'      => null,
            ]
        );
        foreach ([1, 2, 3, 4, 5] as $roleId) {
            UserRole::firstOrCreate(['id_user' => $superadmin->id_user, 'id_role' => $roleId]);
        }

        // ADMIN
        $admin = User::firstOrCreate(
            ['email' => 'admin1@gmail.com'],
            [
                'name'            => 'Admin 1',
                'nim'             => 'L0224000',
                'password'        => Hash::make('admin1234567'),
                'prodi'           => 'Informatika',
                'fakultas'        => 'Fakultas Teknologi Informasi dan Sains Data',
                'no_hp'           => '088227906220',
                'username_github' => '-',
                'created_by'      => $superadmin->id_user,
            ]
        );
        foreach ([3, 4] as $roleId) {
            UserRole::firstOrCreate(['id_user' => $admin->id_user, 'id_role' => $roleId]);
        }

        // SHAFA
        $shafa = User::firstOrCreate(
            ['email' => 'shafafauziah33@gmail.com'],
            [
                'name'            => 'Shafa Rifkika Nur Fauziah',
                'nim'             => 'L0124031',
                'password'        => Hash::make('shafarifkika123'),
                'prodi'           => 'Informatika',
                'fakultas'        => 'Fakultas Teknologi Informasi dan Sains Data',
                'no_hp'           => '088227906220',
                'username_github' => 'shafarifkika',
                'created_by'      => $superadmin->id_user,
            ]
        );
        foreach ([5, 3] as $roleId) {
            UserRole::firstOrCreate(['id_user' => $shafa->id_user, 'id_role' => $roleId]);
        }

        // MUHAMMAD IHZA DZIKRULLAH
        $ihza = User::firstOrCreate(
            ['email' => 'unihza@gmail.com'],
            [
                'name'            => 'Muhammad Ihza Dzikrullah',
                'nim'             => 'L0124024',
                'password'        => Hash::make('muhihza123'),
                'prodi'           => 'Informatika',
                'fakultas'        => 'Fakultas Teknologi Informasi dan Sains Data',
                'no_hp'           => '081548914418',
                'username_github' => 'Frenchfrles',
                'created_by'      => $superadmin->id_user,
            ]
        );
        UserRole::firstOrCreate(['id_user' => $ihza->id_user, 'id_role' => 5]);

        // RAFLI
        $rafli = User::firstOrCreate(
            ['email' => 'ahmadraplyy@gmail.com'],
            [
                'name'            => 'Rafli Ahmad',
                'nim'             => 'L0124030',
                'password'        => Hash::make('rafliahmad123'),
                'prodi'           => 'Informatika',
                'fakultas'        => 'Fakultas Teknologi Informasi dan Sains Data',
                'no_hp'           => '081216210128',
                'username_github' => 'Rafli-Program',
                'created_by'      => $superadmin->id_user,
            ]
        );
        UserRole::firstOrCreate(['id_user' => $rafli->id_user, 'id_role' => 5]);

        // LUTFIYAH
        $lutfiyah = User::firstOrCreate(
            ['email' => 'lutfiyahistiana@gmail.com'],
            [
                'name'            => 'Lutfiyah Istiana',
                'nim'             => 'L0124022',
                'password'        => Hash::make('lutfiyah123'),
                'prodi'           => 'Informatika',
                'fakultas'        => 'Fakultas Teknologi Informasi dan Sains Data',
                'no_hp'           => '081935920710',
                'username_github' => 'lutfiyahistiana',
                'created_by'      => $superadmin->id_user,
            ]
        );
        foreach ([1, 2, 3, 4, 5] as $roleId) {
            UserRole::firstOrCreate(['id_user' => $lutfiyah->id_user, 'id_role' => $roleId]);
        }

        // -------------------------------------------------------
        // 20 DUMMY USERS (id_user: 7–26)
        // Distribusi divisi & tim:
        //   Programming  → Sambergeni  : dummy 1–7   (7 user)
        //   Electronics  → Sriwedari   : dummy 8–13  (6 user)
        //   Manufacturing→ Werkudara   : dummy 14–20 (7 user)
        // -------------------------------------------------------
        $dummyUsers = [
            // --- Programming / Sambergeni ---
            ['name' => 'Andi Pratama',        'nim' => 'L0124101', 'email' => 'andipratama@gmail.com',      'github' => 'andipratama',      'group' => 'programming'],
            ['name' => 'Budi Santoso',         'nim' => 'L0124102', 'email' => 'budisantoso@gmail.com',       'github' => 'budisantoso',       'group' => 'programming'],
            ['name' => 'Citra Dewi',           'nim' => 'L0124103', 'email' => 'citradewi@gmail.com',         'github' => 'citradewi',         'group' => 'programming'],
            ['name' => 'Dian Saputra',         'nim' => 'L0124104', 'email' => 'diansaputra@gmail.com',       'github' => 'diansaputra',       'group' => 'programming'],
            ['name' => 'Eka Wulandari',        'nim' => 'L0124105', 'email' => 'ekawulandari@gmail.com',      'github' => 'ekawulandari',      'group' => 'programming'],
            ['name' => 'Fajar Nugroho',        'nim' => 'L0124106', 'email' => 'fajarnugroho@gmail.com',      'github' => 'fajarnugroho',      'group' => 'programming'],
            ['name' => 'Gita Permata',         'nim' => 'L0124107', 'email' => 'gitapermata@gmail.com',       'github' => 'gitapermata',       'group' => 'programming'],

            // --- Electronics / Sriwedari ---
            ['name' => 'Hendra Wijaya',        'nim' => 'L0124108', 'email' => 'hendrawijaya@gmail.com',      'github' => 'hendrawijaya',      'group' => 'electronics'],
            ['name' => 'Indah Lestari',        'nim' => 'L0124109', 'email' => 'indahlestari@gmail.com',      'github' => 'indahlestari',      'group' => 'electronics'],
            ['name' => 'Joko Susilo',          'nim' => 'L0124110', 'email' => 'jokosusilo@gmail.com',        'github' => 'jokosusilo',        'group' => 'electronics'],
            ['name' => 'Kartika Sari',         'nim' => 'L0124111', 'email' => 'kartikasari@gmail.com',       'github' => 'kartikasari',       'group' => 'electronics'],
            ['name' => 'Lukman Hakim',         'nim' => 'L0124112', 'email' => 'lukmanhakim@gmail.com',       'github' => 'lukmanhakim',       'group' => 'electronics'],
            ['name' => 'Maya Anggraini',       'nim' => 'L0124113', 'email' => 'mayaanggraini@gmail.com',     'github' => 'mayaanggraini',     'group' => 'electronics'],

            // --- Manufacturing / Werkudara ---
            ['name' => 'Nanda Putra',          'nim' => 'L0124114', 'email' => 'nandaputra@gmail.com',        'github' => 'nandaputra',        'group' => 'manufacturing'],
            ['name' => 'Olivia Rahma',         'nim' => 'L0124115', 'email' => 'oliviarahma@gmail.com',       'github' => 'oliviarahma',       'group' => 'manufacturing'],
            ['name' => 'Pandu Kusuma',         'nim' => 'L0124116', 'email' => 'pandukusuma@gmail.com',       'github' => 'pandukusuma',       'group' => 'manufacturing'],
            ['name' => 'Qori Amalia',          'nim' => 'L0124117', 'email' => 'qoriamalia@gmail.com',        'github' => 'qoriamalia',        'group' => 'manufacturing'],
            ['name' => 'Rizky Firmansyah',     'nim' => 'L0124118', 'email' => 'rizkyfirmansyah@gmail.com',   'github' => 'rizkyfirmansyah',   'group' => 'manufacturing'],
            ['name' => 'Sari Rahayu',          'nim' => 'L0124119', 'email' => 'sarirahayu@gmail.com',        'github' => 'sarirahayu',        'group' => 'manufacturing'],
            ['name' => 'Tegar Maulana',        'nim' => 'L0124120', 'email' => 'tegarmaulana@gmail.com',      'github' => 'tegarmaulana',      'group' => 'manufacturing'],
        ];

        foreach ($dummyUsers as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name'            => $data['name'],
                    'nim'             => $data['nim'],
                    'password'        => Hash::make('password123'),
                    'prodi'           => 'Informatika',
                    'fakultas'        => 'Fakultas Teknologi Informasi dan Sains Data',
                    'no_hp'           => '08123456789',
                    'username_github' => $data['github'],
                    'created_by'      => $superadmin->id_user,
                ]
            );

            UserRole::firstOrCreate(['id_user' => $user->id_user, 'id_role' => 5]);
        }
    }
}