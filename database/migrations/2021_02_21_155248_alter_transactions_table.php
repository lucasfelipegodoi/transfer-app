<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTransactionsTable extends Migration
{
    private $tableName = 'transactions';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table($this->tableName, function (Blueprint $table) {
            $table->unsignedBigInteger('wallet_id_payer')
                ->nullable()
                ->after('value');

            $table->unsignedBigInteger('wallet_id_payee')
                ->nullable()
                ->after('value');


            $table->foreign('wallet_id_payer')
                ->references('id')
                ->on('wallet')
                ->onUpdate('NO ACTION')
                ->onDelete('CASCADE');

            $table->foreign('wallet_id_payee')
                ->references('id')
                ->on('wallet')
                ->onUpdate('NO ACTION')
                ->onDelete('CASCADE');

        });    
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table($this->tableName, function (Blueprint $table) {
            $table->dropForeign('transactions_wallet_id_payee_foreign');
            $table->dropForeign('transactions_wallet_id_payer_foreign');
            $table->dropColumn([
                'wallet_id_payee', 
            ]);

            $table->dropColumn([
                'wallet_id_payer', 
            ]);

        });
    }
}
