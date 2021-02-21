<?php

namespace App\Logging;

use Monolog\Logger;

class MailLogger {

    const LOGGER_NAME = "MailHandler";

    /**
     * Cria o logger.
     * @param array config
     * @return \Monolog\Logger
     */

    public function __invoke(array $config)
    {
        $logger = new Logger(self::LOGGER_NAME);
        return $logger->pushHandler(new MailHandler());
    }

}