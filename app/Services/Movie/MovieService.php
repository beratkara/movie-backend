<?php

namespace App\Services\Movie;

use App\Contracts\MovieRepositoryInterface;
use App\Contracts\MovieServiceInterface;
use App\Exceptions\MovieServiceNotFoundException;
use App\Repositories\Movie\MovieCacheRepository;
use App\Repositories\Movie\MovieImdbRepository;
use App\Services\Connection\Guzzle\GuzzleClient;
use Illuminate\Support\Str;
use Throwable;

class MovieService implements MovieServiceInterface
{
    /**
     * @throws Throwable
     */
    public function make($name): MovieRepositoryInterface
    {
        $service = config('movie_services.services.'.$name);
        throw_unless($service, MovieServiceNotFoundException::class, 'Böyle bir servis yok.');

        $method = Str::camel(Str::replace('_', '', $name)) . 'Service';
        throw_if(!method_exists($this, $method), MovieServiceNotFoundException::class, 'Servis bilgisi tanımlanmamış.');

        return $this->{$method}();
    }

    private function collectApiService(): MovieImdbRepository
    {
        $guzzleClient = app(GuzzleClient::class);
        return new MovieImdbRepository($guzzleClient);
    }

    private function cacheService(): MovieCacheRepository
    {
        return new MovieCacheRepository();
    }
}
