<?php

namespace App\Services;

use App\Core\Helpers\JSON;
use App\Core\Services\RepositoryService;
use App\Exceptions\Exception;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Throwable;

class UserService extends RepositoryService
{
    public function __construct(UserRepository $userRepository)
    {
        parent::__construct($userRepository);
    }

    public function save(array $data)
    {
        try {
            $data['id'] = $data['id'] ?? null;


            DB::transaction(function () use (&$data) {

                $data = $this->prepareAndValidateDataBeforeSave($data);

                $shouldCreateWallet = isset($data["id"]) == false; 

                $data['id'] = parent::persist($data);

                if($shouldCreateWallet){
                    $walletService = app(WalletService::class);
                    $walletService->save([
                        "users_id" => $data["id"],
                        "current_balance" => 0.00
                    ]);    
                }
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

    public function prepareAndValidateDataBeforeSave(array $data)
    {
        $userRequest = app(UserRequest::class);
        $validator = Validator::make($data, $userRequest->rules($data), $userRequest->messages());

        if ($validator->fails()) {
            throw new Exception(JSON::encode($validator->messages()));
        }

        $data['password'] = Hash::make($data['password']);

        return $data;
    }

    public function getById($userId){
        $user = $this->find($userId);

        if(is_null($user)) return null;

        $userData = $user->toArray();

        unset($userData["password"]);
        unset($userData["created_at"]);
        unset($userData["updated_at"]);
        unset($userData["deleted_at"]);

        $userData["wallet"] = $user->wallet->toArray();

        return $userData;
    }
}