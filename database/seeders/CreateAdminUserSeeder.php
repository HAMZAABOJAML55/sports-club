<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'user',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678')
        ]);

//         $role = Role::create(['name' => 'Admin']);
//         $permissions = Permission::pluck('id','id')->all();
//         $role->syncPermissions($permissions);
//         $user->assignRole([$role->id]);
    }
}
