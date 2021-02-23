<?php

namespace App\Services;

use App\Core\Helpers\Notification;
use App\Core\Helpers\RequestApi;
use App\Http\Requests\TransactionRequest;
use App\Models\TransactionTypes;
use App\Models\User;
use App\Repositories\TransactionsRepository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\Exception;
use App\Exceptions\ValidacaoException;
use ErrorException;

class TransactionTransferService extends TransactionsService
{
    public function __construct(TransactionsRepository $transactionsRepository, TransactionRequest $transactionRequest)
    {
        parent::__construct($transactionsRepository, $transactionRequest);
    }

    public function execute($data){

        DB::transaction(function () use (&$data) {

            $value = is_numeric($data["value"]) ? $data["value"] : null;

            if($value <= 0){
                throw new ValidacaoException(["erros"=>"O valor tem que ser numérico e maior que zero"]);
            }

            $transactionPayer = [
                "transaction_type_id" => TransactionTypes::TRANSFER,
                "wallet_id" =>  null, 
                "value" => $value * -1,
                "wallet_id_payee" => null
            ];

            $transactionPayee = [
                "transaction_type_id" => TransactionTypes::TRANSFER,
                "wallet_id" =>  null, 
                "value" => $value,
                "wallet_id_payer" => null
            ];

            if(isset($data["payer"]) && isset($data["payee"])){

                try{
                    $walletPayer = User::find($data["payer"])->wallet;
                    $walletPayee = User::find($data["payee"])->wallet;

                    $transactionPayer["wallet_id"] = $walletPayer->id;
                    $transactionPayer["wallet_id_payee"] = $walletPayee->id;

                    $transactionPayee["wallet_id"] = $walletPayee->id;
                    $transactionPayee["wallet_id_payer"] = $walletPayer->id;

                    if(($walletPayer->current_ballance + $value) < 0){
                            throw new ValidacaoException(["erros"=>"Saldo insuficiente"]);
                    }

                } catch(ValidacaoException $validacaoException){
                    throw $validacaoException;
                }catch(ErrorException $e){
                    // id do usuario nao existe, validacao da transaction ira retornar o erro para a API
                }

                $payerReturn = $this->save($transactionPayer);
                $this->save($transactionPayee);

                $this->checkAuthorizer();

                Notification::sendNotification($transactionPayee);

                return $payerReturn;
            }
        });

    }

    private function checkAuthorizer(){

        $requestData = RequestApi::get("https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6");

        if($requestData["status"] != RequestApi::HTTP_CODE_OK)
        {
            throw new Exception("Operação negada - consulte suporte");
        }
    }
}