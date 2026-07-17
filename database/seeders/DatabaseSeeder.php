<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::factory()->create([
            'name' => 'Admin Aksara',
            'email' => 'admin@aksara.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Guru
        User::factory()->create([
            'name' => 'Guru Budi',
            'email' => 'guru@aksara.com',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);

        // Siswa
        User::factory()->create([
            'name' => 'Siswa Andi',
            'email' => 'siswa@aksara.com',
            'password' => bcrypt('password'),
            'role' => 'siswa',
        ]);

        // Guru Tambahan
        User::factory()->create([
            'name' => 'Edi Hidayat',
            'email' => 'edi@aksara.com',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);

        // Siswa Tambahan
        User::factory()->create([
            'name' => 'Bahuraksa Anggraini',
            'email' => 'bahuraksa@aksara.com',
            'password' => bcrypt('password'),
            'role' => 'siswa',
        ]);

        User::factory()->create([
            'name' => 'Febi Santoso',
            'email' => 'febi@aksara.com',
            'password' => bcrypt('password'),
            'role' => 'siswa',
        ]);

        User::factory()->create([
            'name' => 'Prabu Andriani',
            'email' => 'prabu@aksara.com',
            'password' => bcrypt('password'),
            'role' => 'siswa',
        ]);

        User::factory()->create([
            'name' => 'Olivia Damanik',
            'email' => 'olivia@aksara.com',
            'password' => bcrypt('password'),
            'role' => 'siswa',
        ]);

        User::factory()->create([
            'name' => 'Prima Pradipta',
            'email' => 'prima@aksara.com',
            'password' => bcrypt('password'),
            'role' => 'siswa',
        ]);

        User::factory()->create([
            'name' => 'Aurora Namaga',
            'email' => 'aurora@aksara.com',
            'password' => bcrypt('password'),
            'role' => 'siswa',
        ]);

        User::factory()->create([
            'name' => 'Maryanto Dongoran',
            'email' => 'maryanto@aksara.com',
            'password' => bcrypt('password'),
            'role' => 'siswa',
        ]);

        User::factory()->create([
            'name' => 'Wani Mangunsong',
            'email' => 'wani@aksara.com',
            'password' => bcrypt('password'),
            'role' => 'siswa',
        ]);

        User::factory()->create([
            'name' => 'Jasmin Winarsih',
            'email' => 'jasmin@aksara.com',
            'password' => bcrypt('password'),
            'role' => 'siswa',
        ]);

        User::factory()->create([
            'name' => 'Ikhsan Mardhiyah',
            'email' => 'ikhsan@aksara.com',
            'password' => bcrypt('password'),
            'role' => 'siswa',
        ]);
    }
}
