<?php

namespace App\Logging;

use Monolog\Handler\AbstractProcessingHandler;
use Illuminate\Http\Request;
use App\Core\Helpers\JSON;
use App\Services\LogService;
use Illuminate\Validation\Rules\Exists;

class MysqlHandler extends AbstractProcessingHandler {

    private $tipo;

    public function __construct(String $tipo){
        $this->tipo = $tipo;
    }
    
    protected function write(array $record): void
    {
        $request = app(Request::class);
        $logService = app(LogService::class);
        
        if ($this->tipo == 'sistema') {
             $logService->save([
                'instance' => gethostname(),
                'message' => $record['message'],
                'level' => $record['level_name'],
                'method' => $request->getMethod(),
                'context' => JSON::encode($record['context']),                
            ]);
        }

    }
}