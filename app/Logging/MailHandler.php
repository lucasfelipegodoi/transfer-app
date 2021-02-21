<?php

namespace App\Logging;

use App\Core\Helpers\JSON;
use App\Mail\MailTeste;
use Illuminate\Support\Facades\Mail;
use Monolog\Handler\AbstractProcessingHandler;

class MailHandler extends AbstractProcessingHandler {

    protected function write(array $record): void
    {
        $log = [
            'instance' => gethostname(),
            'message' => $record['message'],
            'context' => JSON::encode($record['context']),
            'method' => $record['context']['method'],
            'level' => $record['level_name']
        ];

        Mail::to('teste@teste.com')->send(new MailTeste($log));
    }

}