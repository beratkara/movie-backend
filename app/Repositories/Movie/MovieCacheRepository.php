<?php

namespace App\Repositories\Movie;

use App\Contracts\MovieRepositoryInterface;
use App\Exceptions\ClientException;
use Illuminate\Support\Facades\Cache;
use Throwable;

class MovieCacheRepository implements MovieRepositoryInterface
{
    /**
     * @throws Throwable
     */
    public function searchMovie($keyword): array
    {
        $cacheName = config('movie_services.cache_prefix.search').$keyword;

        $response = Cache::get($cacheName);

        throw_unless($response, ClientException::class, 'Cache serivisinde böyle bir arama işlemi yok.');
        throw_unless($response->success, ClientException::class, $response->result['Error'] ?? 'Bir Hata Oluştu');

        return $response->result;
    }

    /**
     * @throws Throwable
     */
    public function getMovieById($movieId): array
    {
        $cacheName = config('movie_services.cache_prefix.show').$movieId;

        $response = Cache::get($cacheName);

        throw_unless($response, ClientException::class, 'Cache serivisinde böyle bir film verisi yok.');
        throw_unless($response->success, ClientException::class, $response->result['Error'] ?? 'Bir Hata Oluştu');

        return $response->result;
    }
}
