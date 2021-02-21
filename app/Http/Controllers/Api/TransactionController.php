<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Exception;
use App\Http\Controllers\Controller;
use App\Services\TransactionTransferService;
use Illuminate\Http\Request;

class TransactionController extends Controller {

    public function store(Request $request)
    {
        try {
            
            $data = $request->all();

            $transactionTransferService = app(TransactionTransferService::class);

            return $this->responseOk($transactionTransferService->execute($data), []);

        } catch (Exception $exception) {

            return  $this->responseException([], $exception);
        }
    }
}