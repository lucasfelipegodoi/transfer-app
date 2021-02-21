<?php

use App\Logging\MailHandler;
use App\Logging\MailLogger;
use App\Logging\MysqlHandler;
use App\Logging\MysqlLogger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;
use Monolog\Handler\MonologHandlerBrowserConsoleHandler;
use Monolog\Handler\TelegramBotHandler;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that gets used when writing
    | messages to the logs. The name specified in this option should match
    | one of the channels defined in the "channels" configuration array.
    |
    */
    'default' => env('LOG_CHANNEL', 'stack'),
    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog",
    |                    "custom", "stack"
    |
    */
    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => [
                'emergency',
                'alert',
                'critical',
                'error',
                'warning',
                'notice',
                'info',
                'debug'
            ],
        ],
        //Novos channels mapeados por level
        'emergency' => [
            'driver' => 'monolog',
            'handler' => TelegramBotHandler::class,
            'with' => [
                'channel' => env('CHANNEL_TELEGRAM'),
                'apiKey' => env('APIKEY_TELEGRAM')
            ],
            'level' => 'emergency',
        ],
        'alert' => [
            'driver' => 'monolog',
            'via' => MailLogger::class,
            'handler' => MailHandler::class,
            //'formatter' => Monolog\Formatter\HtmlFormatter::class,
            'level' => 'alert',
        ],
        'critical' => [
            'driver' => 'monolog',
            'via' => MailLogger::class,
            'handler' => MailHandler::class,
            //'formatter' => Monolog\Formatter\HtmlFormatter::class,
            'level' => 'critical',
        ],
        'error' => [
            'driver' => 'custom',
            'via' => MysqlLogger::class,
            'handler' => MysqlHandler::class,
            'level' => 'error',
            'with' => [
                'tipo' => 'sistema'
            ]
        ],
        'warning' => [
            'driver' => 'daily',
            'path' => storage_path('logs/warning.log'),
            'level' => 'warning',
            'days' => 14,
        ],
        'notice' => [
            'driver' => 'daily',
            'path' => storage_path('logs/notice.log'),
            'level' => 'notice',
            'days' => 14,
        ],
        'info' => [
            'driver' => 'custom',
            'via' => MysqlLogger::class,
            'handler' => MysqlHandler::class,
            'level' => 'info',
            'with' => [
                'tipo' => 'sistema'
            ]
        ],
        'debug' => [
            'driver' => 'daily',
            'path' => storage_path('logs/debug.log'),
            'level' => 'debug',
            'days' => 14,
        ],
        /*
        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.log'),
            'level' => 'debug',
        ],
        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => 'debug',
            'days' => 14,
        ],
        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => 'Laravel Log',
            'emoji' => ':boom:',
            'level' => 'critical',
        ],
        'papertrail' => [
            'driver'  => 'monolog',
            'level' => 'debug',
            'handler' => SyslogUdpHandler::class,
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),
                'port' => env('PAPERTRAIL_PORT'),
            ],
        ],
        'stderr' => [
            'driver' => 'monolog',
            'handler' => StreamHandler::class,
            'with' => [
                'stream' => 'php://stderr',
            ],
        ],
        'syslog' => [
            'driver' => 'syslog',
            'level' => 'debug',
        ],
        'errorlog' => [
            'driver' => 'errorlog',
            'level' => 'debug',
        ],
        */
    ],
];
