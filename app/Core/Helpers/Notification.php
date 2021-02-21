<?php

namespace App\Core\Helpers;

use App\Exceptions\Exception;

class Notification
{
    public static function sendNotification($data){

        $result = RequestApi::get("https://run.mocky.io/v3/b19f7b9f-9cbf-4fc6-ad22-dc30601aec04");  

        if($result["status"] != RequestApi::HTTP_CODE_OK)
        {
            throw new Exception("Falha no envio de notificação - transação cancelada");
        }

        if($result["body"]["message"] != "Enviado")
        {
            throw new Exception("Falha no envio de notificação - transação cancelada");
        }
    }
}
