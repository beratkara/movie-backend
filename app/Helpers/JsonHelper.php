<?php

namespace App\Helpers;

class JsonHelper
{
    public static function encode(array $data): string
    {
        return (string)json_encode($data, JSON_HEX_QUOT);
    }

    public static function decode(string $data): object
    {
        return (object)json_decode($data, true);
    }

    public static function isJson($string): bool
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}
