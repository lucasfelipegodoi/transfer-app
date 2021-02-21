<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Exception;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use ErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {

    public function show(Request $request, $id)
    {
        try {
            $userService = app(UserService::class);
            return $this->responseOk($userService->getById($id), []);
        } catch (Exception $exception) {
            return  $this->responseException([], $exception);
        } 
    }

    public function store(Request $request)
    {
        try {
            
            $data = $request->all();

            $userService = app(UserService::class);

            return $this->responseOk($userService->save($data), []);

        } catch (Exception $exception) {
            return  $this->responseException([], $exception);
        }
    }
}