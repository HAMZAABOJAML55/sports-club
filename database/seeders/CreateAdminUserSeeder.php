<?php

namespace Database\Seeders;

use App\Models\Club;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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

        $club = Club::create([

            'name' => 'admin',
            'user_name' => 'admin_admin',
            'email' =>'admin@admin.com',
            'phone' => '1233333',
            'subscribes_id' => 1,
            'password' =>bcrypt('12345678'),
            'image_path' => 'Null',
        ]);
         User::create([
            'club_id' => $club->id,
            'name' => $club->name,
            'email' => $club->email,
            'password' => $club->password,
            'permission' => 'admin',
        ]);


//         $role = Role::create(['name' => 'Admin']);
//         $permissions = Permission::pluck('id','id')->all();
//         $role->syncPermissions($permissions);
//         $user->assignRole([$role->id]);
    }
}
