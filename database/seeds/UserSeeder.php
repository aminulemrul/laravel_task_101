<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'username' => 'sohana',
            'email' => 'borna350@gmail.com',
            'password' => bcrypt('12345678'),
            'fullName' => 'Sohana Kabir Barna',
            'phone' => '01733878941',
            'dept_id' => null,
            'status' => 'Active',
            'type' => 'Main Admin',
        ]);

        $role = Role::create(['name' => 'Main Admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
