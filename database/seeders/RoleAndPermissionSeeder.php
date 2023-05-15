<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'delete-users']);

        Permission::create(['name' => 'create-request']);
        Permission::create(['name' => 'edit-request']);
        Permission::create(['name' => 'delete-request']);
        Permission::create(['name' => 'verify-request']);

        $adminRole = Role::create(['name' => 'Admin']);
        $supervisorRole = Role::create(['name' => 'Supervisor']);
        $normalUserRole = Role::create(['name' => 'Normal']);

        /** dastresi admin be hamye amaliyat */
        $adminRole->givePermissionTo([
            'create-users',
            'edit-users',
            'delete-users',
            'create-request',
            'edit-request',
            'delete-request',
            'verify-request',
        ]);
        /** dastresi sarparast be bakhshi az amaliyat */
        $supervisorRole->givePermissionTo([
            'create-request',
            'edit-request',
            'delete-request',
            'verify-request',
        ]);
        /** dastrasi karbar faghat baraye sakht request */
        $normalUserRole->givePermissionTo([
            'create-request',
        ]);
    }
}
