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
        Permission::create(['name' => 'view-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'delete-users']);

        Permission::create(['name' => 'journal-multiple-accounts']);
        Permission::create(['name' => 'access-market-data']);
        Permission::create(['name' => 'access-trade-entries']);
        Permission::create(['name' => 'access-trade-performance']);

        $admin = Role::create(['name' => 'Admin']);
        $user = Role::create(['name' => 'User']);

        // on top of user role, will be one of subscription role
        $basic = Role::create(['name' => 'Basic']);
        $standard = Role::create(['name' => 'Standard']);
        $premium = Role::create(['name' => 'Premium']);

        $admin->givePermissionTo([
            'create-users',
            'view-users',
            'edit-users',
            'delete-users',
        ]);

        $user->givePermissionTo([
            'access-trade-entries',
            'access-trade-performance'
        ]);

        $standard->givePermissionTo([
            'journal-multiple-accounts',
        ]);

        $premium->givePermissionTo([
            'journal-multiple-accounts',
            'access-market-data'
        ]);

    }
}
