<?php

namespace App\Repositories\Movie;

use App\Contracts\MovieRepositoryInterface;
use App\Exceptions\ClientException;
use App\Services\ThirdParty\CollectApi\DTO\Collection\ImdbCollection;
use App\Services\ThirdParty\CollectApi\DTO\Data\ImdbShowData;
use App\Services\ThirdParty\CollectApi\DTO\ImdbDto;
use Illuminate\Support\Facades\Cache;
use Throwable;

class MovieCacheRepository implements MovieRepositoryInterface
{
    /**
     * @throws Throwable
     */
    public function searchMovie($keyword): array
    {
        $response = Cache::get('Search-'.$keyword);

        throw_unless($response, ClientException::class, 'Cache serivisinde böyle bir arama işlemi yok.');
        throw_unless($response->success, ClientException::class, $response->result['Error'] ?? 'Bir Hata Oluştu');

        $data = new ImdbDto([
            'data' => ImdbCollection::fromArray($response->result),
        ]);
        return $data->toArray();
    }

    /**
     * @throws Throwable
     */
    public function getMovieById($movieId): array
    {
        $response = Cache::get('Movie-'.$movieId);

        throw_unless($response, ClientException::class, 'Cache serivisinde böyle bir film verisi yok.');
        throw_unless($response->success, ClientException::class, $response->result['Error'] ?? 'Bir Hata Oluştu');

        $data = new ImdbDto([
            'data' => ImdbShowData::fromApi($response->result),
        ]);
        return $data->toArray();
    }
}
