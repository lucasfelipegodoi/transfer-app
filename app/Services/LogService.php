<?php

namespace App\Services;

use App\Exceptions\Exception;
use App\Core\Services\RepositoryService;
use Illuminate\Database\QueryException;
use App\Repositories\LogRepository;
use Throwable;

class LogService extends RepositoryService
{
    public function __construct(LogRepository $logRepository)
    {
        parent::__construct($logRepository);
    }

    public function save(array $data)
    {
        try {
            parent::persist($data);
        } catch (QueryException $queryException) {
            throw new Exception($queryException->getMessage(), $queryException->getCode(), $queryException);
        } catch (Exception $exception) {
            throw $exception;
        } catch (Throwable $throwable) {
            throw $throwable;
        }        
    }
}
