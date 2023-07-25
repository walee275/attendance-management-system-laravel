<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::create(['name' => 'admin']);
        $role_student = Role::create(['name' => 'student']);



        $permission_create = Permission::create(['name' => 'create']);
        $permission_read = Permission::create(['name' => 'read']);
        $permission_edit = Permission::create(['name' => 'edit']);
        $permission_delete = Permission::create(['name' => 'delete']);

        $permissions = [ $permission_create, $permission_read,$permission_edit,$permission_delete ];

        $role_admin->syncPermissions($permissions);
        $role_student->givePermissionTo($permission_read);


    }
}
