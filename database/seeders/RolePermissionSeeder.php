<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create roles
        $roleAdmin = Role::create(['name' => 'Super Admin']);
        $roleUser = Role::create(['name' => 'Admin']);
        // Permission list as array
        $permissions = [
            //User Create
            'user.create',
            'user.view',
            'user.edit',
            'user.delete',

            //Role Create
            'role.create',
            'role.view',
            'role.edit',
            'role.delete',
            //Admin Create
            'Admin Create',
            'Admin View',
            'Admin Edit',
            'Admin Delete',
        ];


        //Create and Assign permissions
        for ($i = 0; $i < count($permissions); $i++) {
            $permission = Permission::create([
                'name' => $permissions[$i]
            ]);

            $roleAdmin->givePermissionTo($permission);
            $permission->assignRole($roleAdmin);
        }
    }
}
