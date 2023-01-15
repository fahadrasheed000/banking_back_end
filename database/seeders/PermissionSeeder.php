<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Schema;

class PermissionSeeder extends Seeder
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

        Permission::truncate();

        Schema::enableForeignKeyConstraints();

        $data = array(
         
            array(
                'name' => 'get-bank',
                'guard_name'=>'web'
            ),


        );
        Permission::insert($data);//insert all data in bulk

    }
}
