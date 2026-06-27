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
    }
}
