<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

use Spatie\Permission\Models\Role;

use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //truncate table before insert data to get fresh data
        Schema::disableForeignKeyConstraints();

        User::truncate();

        Role::truncate();

        Schema::enableForeignKeyConstraints();

        $user = User::create([
        	'name' => 'Admiral',
        	'email' => 'admiral@gmail.com',
        	'password' => bcrypt('12345678'),
        ]);
    
        $role = Role::create(['name' => 'Customer']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);


        $user = User::create([
        	'name' => 'Fahad Rasheed',
        	'email' => 'admin@gmail.com',
        	'password' => bcrypt('12345678'),
        ]);
    
       

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        

    }
}
