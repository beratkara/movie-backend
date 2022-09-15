<?php

namespace App\Services\Connection\Guzzle;

use App\Contracts\ConnectionInterface;
use App\Exceptions\ClientException;
use App\Helpers\JsonHelper;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Facades\Log;

class GuzzleClient implements ConnectionInterface
{
    private Client $client;
    private array $headers = [];
    private array $options = [];

    public function __construct(array $options)
    {
        $this->setOptions($options);
    }

    public function init()
    {
        $this->client = new Client($this->options);
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param  array  $options
     */
    public function setOptions(array $options): void
    {
        foreach ($options as $key => $value)
        {
            $this->options[$key] = $value;
        }
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param  array  $headers
     */
    public function setHeaders(array $headers): void
    {
        foreach ($headers as $key => $value)
        {
            $this->headers[$key] = $value;
        }
    }

    public function get($url)
    {
        return $this->client->getAsync($url, [
            'headers' => $this->headers
        ])->then(
            function ($response) {return $this->response($response);},
            function ($exception) {return $this->exception($exception);}
        )->wait();
    }


    public function post(string $url, array $parameter = [])
    {
        $data = [
            'headers' => $this->headers
        ];

        return $this->client->postAsync($url,$data)->then(
            function ($response) {return $this->response($response);},
            function ($exception) {return $this->exception($exception);}
        )->wait();
    }

    public function response($response): object
    {
        $data = $response->getBody()->getContents();
        return JsonHelper::isJson($data) ? JsonHelper::decode($data) : $data;
    }

    /**
     * @throws ClientException
     */
    public function exception($exception)
    {
        Log::channel('custom')->info('İstek tamamlanamadı : ' . $exception->getMessage(), $exception->getHandlerContext());

        switch (get_class($exception)) {
            case ConnectException::class:
                throw new ClientException('Servise bağlanırken hata oluştu !', $exception->getCode());
            default:
                throw new ClientException($exception->getMessage(), $exception->getCode());
        }
    }
}
