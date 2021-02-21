<?php

namespace App\Services;

use App\Http\Requests\TransactionRequest;
use App\Models\TransactionTypes;
use App\Repositories\TransactionsRepository;

class TransactionDepositService extends TransactionsService
{
    public function __construct(TransactionsRepository $transactionsRepository, TransactionRequest $transactionRequest)
    {
        parent::__construct($transactionsRepository, $transactionRequest);
    }

    public function execute($data){

        $transactionData = [
            "transaction_type_id" => TransactionTypes::DEPOSIT,
            "wallet_id" => $data["wallet_id"] ?? null, 
            "value" => $data["value"] ?? null
        ];

        return $this->save($transactionData);
    }
}