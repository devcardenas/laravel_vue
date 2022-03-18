<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_administrativo = Role::create(['name' => 'administrativo']);
        $role_prestatario = Role::create(['name' => 'prestatario']);

        Permission::create(['name' => 'view_books'])->syncRoles($role_administrativo, $role_prestatario);
        Permission::create(['name' => 'create_books'])->assignRole($role_administrativo);
        Permission::create(['name' => 'edit_books'])->assignRole($role_administrativo);
        Permission::create(['name' => 'delete_books'])->assignRole($role_administrativo);
        Permission::create(['name' => 'view_books_loans'])->assignRole($role_administrativo);
        Permission::create(['name' => 'borrow_books'])->assignRole($role_prestatario);
        Permission::create(['name' => 'return_books_loans'])->assignRole($role_prestatario);
    }
}
