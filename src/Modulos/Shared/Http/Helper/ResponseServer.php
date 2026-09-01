<?php

namespace App\Modulos\Shared\Http\Helper;

class ResponseServer
{
    public static function responseArray(int $statusCode, mixed $message = null, mixed $data = null): array
    {
        return [
            "statusCode" => $statusCode,
            "message" => $message,
            "data" => $data
        ];
    }
}
