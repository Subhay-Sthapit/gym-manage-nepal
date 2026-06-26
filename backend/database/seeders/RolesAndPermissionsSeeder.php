<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Define Permissions
        $permissions = [
            // platform Owner/Super Admin
            'create gym', 'suspend gym', 'configure gym', 'view gym',
            // gym owner
            'add plan', 'edit plan', 'delete plan', 'view plan', 'view members', 'suspend member',
            'notify member', 'generate invoice', 'delete bill', 'edit gym', 'view attendance', 'register member',
            'generate qr'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Creating Roles
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $superAdmin->syncPermissions(Permission::all()); // super admin has all the permissions

        $gymOwner = Role::firstOrCreate(['name' => 'gym-owner']);
        $gymOwner->syncPermissions(
            [
                'add plan', 'edit plan', 'delete plan', 'view plan', 'view members', 'suspend member',
                'notify member', 'generate invoice', 'delete bill', 'edit gym', 'view attendance',
                'register member', 'generate qr'
            ]
        );
    }
}
