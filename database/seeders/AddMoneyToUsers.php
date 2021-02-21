<?php

namespace Database\Seeders;

use App\Services\TransactionDepositService;
use Illuminate\Database\Seeder;

class AddMoneyToUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transaction = app(TransactionDepositService::class);

        $transaction->execute([
            "wallet_id" => 1,
            "value" => 256.99
        ]);
    }
}
