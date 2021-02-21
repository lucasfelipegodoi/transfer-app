<?php

namespace App\Logging;

use Monolog\Logger;
use App\Logging\MysqlHandler;

class MysqlLogger 
{
    const LOGGER_NAME = "MysqlHandler";
    
    /**
     * Cria o logger.
     * @param array config
     * @return \Monolog\Logger
     */
    public function __invoke(array $config)
    {
        $tipo = $config['with']['tipo'];
        $logger = new Logger(self::LOGGER_NAME);

        return $logger->pushHandler(new MysqlHandler($tipo));
    }
}