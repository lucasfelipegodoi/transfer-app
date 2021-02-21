<?php

namespace App\Core\Helpers;

use Illuminate\Support\Facades\Http;

class RequestApi
{

    public const HTTP_CODE_OK = 200;

    public static function get($url)
    {
        $response = Http::get($url);
        return [
            "ok" => $response->ok(),
            "failed" => $response->failed(),
            "body" => $response->json(),
            "status" => $response->status()
        ];
    }
}
