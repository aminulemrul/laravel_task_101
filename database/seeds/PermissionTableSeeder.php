<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'department-list',
            'department-create',
            'department-edit',
            'department-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'work-list',
            'work-create',
            'work-edit',
            'work-delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
