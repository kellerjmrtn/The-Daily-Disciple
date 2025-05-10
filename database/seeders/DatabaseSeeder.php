<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionAndRoleSeeder::class);

        // Create admin user
        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
        ])->assignRole('admin');

        // Create editor user
        User::factory()->create([
            'name' => 'Test Editor',
            'email' => 'editor@example.com',
        ])->assignRole('editor');

        $this->call(DevotionSeeder::class);
    }
}
