<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\BankAccount;

use Illuminate\Support\Facades\Schema;

class BankAccountSeeder extends Seeder
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

        BankAccount::truncate();

        Schema::enableForeignKeyConstraints();

        $data = array(

            array(
                'account_number' => '100000000000',
                'bank_id' => '1'
            ),
            array(
                'account_number' => '200000000000',
                'bank_id' => '1'
            ),
            array(
                'account_number' => '3000000000000',
                'bank_id' => '2'
            ),
            array(
                'account_number' => '4000000000000',
                'bank_id' => '2'
            ),
           

        );
        BankAccount::insert($data);
    }
}
