<?php

namespace App\Services;

use App\Core\Services\RepositoryService;
use App\Exceptions\Exception;
use App\Models\TransactionTypes;
use App\Repositories\WalletRepository;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class WalletService extends RepositoryService
{
    public function __construct(WalletRepository $walletRepository)
    {
        parent::__construct($walletRepository);
    }

    public function save(array $data)
    {
        try {
            $data['id'] = $data['id'] ?? null;

            DB::transaction(function () use (&$data) {
                $data = $this->prepareAndValidateDataBeforeSave($data);
                $data['id'] = parent::persist($data);
            });

            return [
                'id' => $data['id'],
            ];

        } catch (QueryException $queryException) {
            throw new Exception($queryException->getMessage(), $queryException->getCode(), $queryException);
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function updateCurrentBalance($walletId){

        $transactionsService = app(TransactionsService::class);
        $wallet = $this->find($walletId);
        $wallet->current_ballance = $transactionsService->fetchAll(["wallet_id" => $walletId])->sum("value");
        $wallet->save();
    }
}