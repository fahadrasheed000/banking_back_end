<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Bank;

use Illuminate\Support\Facades\Schema;

class BankSeeder extends Seeder
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

        Bank::truncate();

        Schema::enableForeignKeyConstraints();


        $data = array(

            array(
                'name' => 'MayBank',
                'branch_code' => 'MB100'
            ),
            array(
                'name' => 'CIMB',
                'branch_code' => 'CB100'
            ),
          

        );
        Bank::insert($data);
    }
}
