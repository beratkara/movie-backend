<?php

namespace App\Providers;

use App\Contracts\RateRepositoryInterface;
use App\Repositories\Rate\RateRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RateRepositoryInterface::class, RateRepository::class);
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
