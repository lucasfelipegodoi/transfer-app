<?php

namespace App\Services;

use App\Core\Services\RepositoryService;
use App\Http\Requests\TransactionRequest;
use App\Repositories\TransactionsRepository;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Throwable;
use App\Exceptions\Exception;


class TransactionsService extends RepositoryService
{
    public function __construct(TransactionsRepository $transactionsRepository, TransactionRequest $transactionRequest)
    {
        parent::__construct($transactionsRepository);
        $this->request = $transactionRequest;
    }

    public function save(array $data)
    {

        try {
            $data['id'] = $data['id'] ?? null;

            DB::transaction(function () use (&$data) {
                $data = $this->prepareAndValidateDataBeforeSave($data);
                $data['id'] = parent::persist($data);

                $walletService = app(WalletService::class);
                $walletService->updateCurrentBalance($data["wallet_id"]);
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

    public function fetchAll(array $filter = [], $paginated = false)
    {
        try {
            $filters = [
                'id' => $filter['id'] ?? null,
                'wallet_id' => $filter['wallet_id'] ?? null,
                'transaction_type_id' => $filter['transaction_type_id'] ?? null,
            ];

            $clientes = $this->query($filters)->get();

            return $clientes->count() ? $clientes : [];
        } catch (QueryException $queryException) {
            throw new Exception($queryException->getMessage(), $queryException->getCode(), $queryException);
        } catch (Exception $exception) {
            throw $exception;
        } catch (Throwable $throwable) {
            throw new Exception('Houve um erro durante a consulta.', $throwable->getCode(), $throwable);
        }
    }

}