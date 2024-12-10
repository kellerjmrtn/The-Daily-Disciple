<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionAndRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $admin = Role::create(['name' => 'admin']);

        // Create permissions
        $devotionPerms = $this->resourcePermission('devotions');

        // Assign perms
        $admin->givePermissionTo($devotionPerms);
    }

    protected function resourcePermission(string $name): array
    {
        return [
            Permission::create(['name' => "$name.view.any"]),
            Permission::create(['name' => "$name.view.own"]),
            Permission::create(['name' => "$name.create"]),
            Permission::create(['name' => "$name.update.any"]),
            Permission::create(['name' => "$name.update.own"]),
            Permission::create(['name' => "$name.delete.any"]),
            Permission::create(['name' => "$name.delete.own"]),
        ];
    }
}
