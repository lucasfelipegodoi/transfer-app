<?php

namespace App\Core\Helpers;

class JSON
{
    public static function encode($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public static function decode($value)
    {
        return json_decode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public static function isAValidJSON($value)
    {
        return json_decode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ? true : false;
    }
}
