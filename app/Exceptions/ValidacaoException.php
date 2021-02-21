<?php

namespace App\Exceptions;

use App\Core\Helpers\Log;
use Throwable;

class ValidacaoException extends Exception
{
    public function __construct($message, $code = 0 , Throwable $previous = null)
    {
        $messageException = $message['erros'];
        parent::__construct($messageException, $code, $previous);
    }
}