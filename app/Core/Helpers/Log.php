<?php

namespace App\Core\Helpers;

use Illuminate\Support\Facades\Log as LogIlluminate;

class Log
{
    private static function channel(string $channel = null)
    {
        return LogIlluminate::channel($channel);
    }

    private static function stack(array $channels, string $channel = null)
    {
        return LogIlluminate::stack($channels, $channel);
    }

    public static function emergency(string $message, array $options = [])
    {
        $context = $options['context'] ?? [];
        $channel = $options['channel'] ?? 'emergency';
        $channels = $options['channels'] ?? ['emergency'];

        self::stack($channels, $channel)->emergency($message, $context);
    }

    public static function alert(string $message, array $options = [])
    {
        $context = $options['context'] ?? [];
        $channel = $options['channel'] ?? 'alert';
        $channels = $options['channels'] ?? ['alert'];

        self::stack($channels, $channel)->alert($message, $context);
    }

    public static function critical(string $message, array $options = [])
    {
        $context = $options['context'] ?? [];
        $channel = $options['channel'] ?? 'critical';
        $channels = $options['channels'] ?? ['critical'];

        self::stack($channels, $channel)->critical($message, $context);
    }

    public static function error(string $message, array $options = [])
    {
        $context = $options['context'] ?? [];
        $channel = $options['channel'] ?? 'error';
        $channels = $options['channels'] ?? ['error'];

        self::stack($channels, $channel)->error($message, $context);
    }

    public static function warning(string $message, array $options = [])
    {
        $context = $options['context'] ?? [];
        $channel = $options['channel'] ?? 'warning';
        $channels = $options['channels'] ?? ['warning'];

        self::stack($channels, $channel)->warning($message, $context);
    }

    public static function notice(string $message, array $options = [])
    {
        $context = $options['context'] ?? [];
        $channel = $options['channel'] ?? 'notice';
        $channels = $options['channels'] ?? ['notice'];

        self::stack($channels, $channel)->notice($message, $context);
    }

    public static function info(string $message, array $options = [])
    {
        $context = $options['context'] ?? [];
        $channel = $options['channel'] ?? 'info';
        $channels = $options['channels'] ?? ['info'];

        self::stack($channels, $channel)->info($message, $context);
    }

    public static function debug(string $message, array $options = [])
    {
        $context = $options['context'] ?? [];
        $channel = $options['channel'] ?? 'debug';
        $channels = $options['channels'] ?? ['debug'];

        self::stack($channels, $channel)->debug($message, $context);
    }
}
