<?php

namespace App\Providers;

use App\Contracts\MovieRepositoryInterface;
use App\Exceptions\MovieServiceNotFoundException;
use App\Implementations\MovieImplementations;
use App\Repositories\Movie\MovieImdbRepository;
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
        $this->app->bind(MovieService::class, MovieImplementations::class);
        if (request()->hasHeader('service')) {
            $service = config('movie_services.services.'.request()->header('service'));
            throw_unless($service, MovieServiceNotFoundException::class, 'Böyle bir servis yok.');
            $this->app->bind(MovieRepositoryInterface::class, $service);
        } else {
            $this->app->bind(MovieRepositoryInterface::class, MovieImdbRepository::class);
        }
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
