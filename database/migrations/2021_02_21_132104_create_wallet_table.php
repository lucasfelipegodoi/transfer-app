<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('users_id')->unique();
            $table->decimal("current_ballance");

            $table->foreign('users_id')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('NO ACTION')
                    ->onDelete('CASCADE');


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
        Schema::dropIfExists('wallet');
    }
}
