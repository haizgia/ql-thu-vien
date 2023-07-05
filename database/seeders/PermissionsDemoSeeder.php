<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'read books']);
        Permission::create(['name' => 'create books']);
        Permission::create(['name' => 'edit books']);
        Permission::create(['name' => 'delete books']);

        Permission::create(['name' => 'read users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        Permission::create(['name' => 'read lend-return']);
        Permission::create(['name' => 'create lend-return']);
        Permission::create(['name' => 'edit lend-return']);
        Permission::create(['name' => 'delete lend-return']);

        Permission::create(['name' => 'read permissions-roles']);
        Permission::create(['name' => 'create permissions-roles']);
        Permission::create(['name' => 'edit permissions-roles']);
        Permission::create(['name' => 'delete permissions-roles']);

        // create roles and assign existing permissions
        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('read books');
        $role2->givePermissionTo('create books');
        $role2->givePermissionTo('edit books');
        $role2->givePermissionTo('delete books');
        $role2->givePermissionTo('read users');
        $role2->givePermissionTo('create users');
        $role2->givePermissionTo('edit users');
        $role2->givePermissionTo('delete users');
        $role2->givePermissionTo('read lend-return');
        $role2->givePermissionTo('create lend-return');
        $role2->givePermissionTo('edit lend-return');
        $role2->givePermissionTo('delete lend-return');

        $role3 = Role::create(['name' => 'Super-Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider
    }
}
