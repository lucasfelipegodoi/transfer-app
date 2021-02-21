<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Exception;
use App\Http\Controllers\Controller;
use App\Services\TransactionDepositService;
use Illuminate\Http\Request;

class DepositController extends Controller {

    public function store(Request $request)
    {
        try {
            
            $data = $request->all();

            $transactionDepositService = app(TransactionDepositService::class);

            return $this->responseOk($transactionDepositService->execute($data), []);

        } catch (Exception $exception) {
            return  $this->responseException([], $exception);
        }
    }
}