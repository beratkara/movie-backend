<?php

namespace App\Providers;

use App\Services\Connection\Guzzle\GuzzleClient;
use App\Services\ThirdParty\CollectApi\ImdbApi;
use Illuminate\Support\ServiceProvider;

class ClientServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GuzzleClient::class, function ($app) {
            return new ImdbApi($this->clientOptions());
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    protected function clientOptions()
    {
        $config = $this->app['config']->get('services.client');

        if (!$config['timeout']) {
            throw new \RuntimeException('Client config `timeout` not null');
        }

        return $config;
    }
}
