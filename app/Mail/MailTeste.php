<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailTeste extends Mailable {

    use Queueable, SerializesModels;

    public $instance;
    public $message;
    public $context;
    public $method;
    public $level;

    public function __construct(array $log)
    {
        $this->instance = $log['instance'];
        $this->message = $log['message'];
        $this->context = $log['context'];
        $this->method = $log['method'];
        $this->level = $log['level'];
    }

    public function build()
    {
        return $this->markdown('mail.teste');
    }
}