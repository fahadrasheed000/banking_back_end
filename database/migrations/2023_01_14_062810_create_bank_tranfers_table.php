<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankTranfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_tranfers', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->unsignedBigInteger('user_id');
            $table->index('user_id');
            $table->unsignedBigInteger('from_account');
            $table->index('from_account');
            $table->unsignedBigInteger('to_account');
            $table->index('to_account');
            $table->double("amount",10,2)->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_tranfers');
    }
}
