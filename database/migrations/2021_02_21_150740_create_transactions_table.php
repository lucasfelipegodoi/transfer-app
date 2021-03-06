<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('wallet_id');
            $table->foreign('wallet_id')
                    ->references('id')
                    ->on('wallet')
                    ->onUpdate('NO ACTION')
                    ->onDelete('CASCADE');

            $table->unsignedBigInteger('transaction_type_id');
            $table->foreign('transaction_type_id')
                    ->references('id')
                    ->on('transaction_types')
                    ->onUpdate('NO ACTION')
                    ->onDelete('CASCADE');            

            $table->decimal("value");

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
        Schema::dropIfExists('transactions');
    }
}
