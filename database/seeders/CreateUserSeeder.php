<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'User',
            'email' => 'user@localhost.com',
            'password' => bcrypt('user123')
        ]);

        $role = Role::create(['name' => 'User']);
        $permissions = Permission::where('name','like','permintaan%')->pluck('id','id');
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}