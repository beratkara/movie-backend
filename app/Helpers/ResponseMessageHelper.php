<?php

namespace App\Helpers;

class ResponseMessageHelper
{
    public string $status;
    public string $message;
    public string $text;
    public array $data;

    public static function error($text = null, $data = null): ResponseMessageHelper
    {
        $params = new self();
        $params->status = 'Hata';
        $params->message = 'Hata Oluştu';
        if (!is_null($text)) {
            $params->text = $text;
        }
        if (!is_null($data)) {
            $params->data = $data;
        }
        return $params;
    }

    public static function success($text = null, $data = null): ResponseMessageHelper
    {
        $params = new self();
        $params->status = 'Başarılı';
        $params->message = 'İşlem Başarılı';
        if (!is_null($text)) {
            $params->text = $text;
        }
        if (!is_null($data)) {
            $params->data = $data;
        }
        return $params;
    }
}
