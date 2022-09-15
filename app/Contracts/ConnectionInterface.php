<?php

namespace App\Contracts;

use App\Exceptions\ClientException;

interface ConnectionInterface
{
    public function init();
    public function getHeaders(): array;
    public function setHeaders(array $headers): void;
    public function getOptions(): array;
    public function setOptions(array $options): void;
    public function get(string $url);
    public function post(string $url, array $parameter = []);
    public function response($response): object;
    /**
     * @throws ClientException
     */
    public function exception($exception);
}
