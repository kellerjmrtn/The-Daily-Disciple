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
        $editor = Role::create(['name' => 'editor']);

        // Create permissions
        $devotionPerms = $this->resourcePermission('devotions');

        // Assign perms
        $admin->givePermissionTo($devotionPerms);
        $editor->givePermissionTo([
            'devotions.view.any',
            'devotions.create',
            'devotions.update.own',
            'devotions.delete.own',
        ]);
    }

    protected function resourcePermission(string $name): array
    {
        return [
            Permission::create(['name' => "$name.view.any"]),
            Permission::create(['name' => "$name.create"]),
            Permission::create(['name' => "$name.update.any"]),
            Permission::create(['name' => "$name.update.own"]),
            Permission::create(['name' => "$name.delete.any"]),
            Permission::create(['name' => "$name.delete.own"]),
        ];
    }
}
