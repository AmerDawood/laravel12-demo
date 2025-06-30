<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'manage courses']);
        Permission::create(['name' => 'view courses']);
        Permission::create(['name' => 'enroll courses']);

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(['manage users', 'manage courses', 'view courses']);

        $instructorRole = Role::create(['name' => 'instructor']);
        $instructorRole->givePermissionTo(['manage courses', 'view courses']);

        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo(['view courses', 'enroll courses']);
    }
}
