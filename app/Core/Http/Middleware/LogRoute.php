<?php

namespace App\Core\Http\Middleware;

use Closure;
use App\Core\Helpers\Log;

class LogRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $log = [
            'uri' => $request->getUri(),
            'method' => $request->getMethod(),
            'request' => $request->all(),
            'response' => $response->getContent()
        ];
        
        Log::info('Request',[
            'context' => $log,
        ]);


        return $response;
    }
}
