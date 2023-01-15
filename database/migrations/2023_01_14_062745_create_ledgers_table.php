<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ledgers', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->unsignedBigInteger('user_id');
            $table->index('user_id');
            $table->unsignedBigInteger('account_id');
            $table->index('account_id');
            $table->unsignedBigInteger('deponsit_id')->default(0);
            $table->index('deponsit_id');
            $table->unsignedBigInteger('transfer_id')->default(0);
            $table->index('transfer_id');
            $table->double("debit",10,2)->default(0);
            $table->double("credit",10,2)->default(0);
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
        Schema::dropIfExists('ledgers');
    }
}
