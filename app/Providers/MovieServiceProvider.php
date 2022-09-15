<?php

namespace App\Providers;

use App\Contracts\MovieServiceInterface;
use App\Services\Movie\MovieService;
use Illuminate\Support\ServiceProvider;
use Throwable;

class MovieServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     * @throws Throwable
     */
    public function register()
    {
        $this->app->bind(MovieServiceInterface::class, MovieService::class);
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
}
