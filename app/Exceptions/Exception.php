<?php

namespace App\Exceptions;

use Exception as NativeException;
use Throwable;
use App\Core\Helpers\Log;
use Illuminate\Http\Request;
//use Auth;

class Exception extends NativeException
{
    public function __construct($message, $code = 0 , Throwable $previous = null )
    {
        $request = app(Request::class);
        $code = is_numeric($code) ? $code : 500;

        parent::__construct($message, $code, $previous);

        Log::error('Exception', [
            'context' => [
                'message' => $message,
                'request'   => [
                    'uri' => $request->getUri(),
                    'ip' => $request->ip(),
                    'host' => $request->getHost(),
                    'method' => $request->getMethod(),
                    //'user' => Auth::guest() ? 'guest' : Auth::user(),
                    'parameters' => $request->all(),
                    //'files' => $request->allFiles(),
                ],
                'code'      => $code,
                /**
                 * @todo Validar porque o gettrace não está sendo convertido para json.
                 */
                //'trace'     => parent::getTrace(),
            ],
        ]);
    }
}
