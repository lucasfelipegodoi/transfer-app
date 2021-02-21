<?php

namespace App\Http\Controllers;

use App\Exceptions\ValidacaoException;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function responseOk($data, $errorMessage = [])
    {
        return response()->json([
            'data' => $data,
            'error_message' => $errorMessage,
            'success' => 1,
        ]);
    }
    
    public function responseOkGetUnique($data, $errorMessage = [])
    {
        return response()->json($data);
    }

    public function responseException($data, $exception)
    {
     
        $errorCode = 500;

        if($exception instanceof ValidacaoException){
            $errorCode = 422;
        }

        return response()->json([
            'data' => [],
            'error_messages' => [$exception->getMessage()],
            'success' => 0,
        ], $errorCode);
    }
}
