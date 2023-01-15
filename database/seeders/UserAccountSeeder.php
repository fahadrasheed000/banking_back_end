<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\UserAccount;

use Illuminate\Support\Facades\Schema;

class UserAccountSeeder extends Seeder
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

        UserAccount::truncate();

        Schema::enableForeignKeyConstraints();

        $data = array(

            array(
                'user_id' => '1',
                'account_id' => '1',
                'balance' => '5000'
            ),
            array(
                'user_id' => '2',
                'account_id' => '3',
                'balance' => '4000'
            ),
        );
        UserAccount::insert($data);
    }
}
