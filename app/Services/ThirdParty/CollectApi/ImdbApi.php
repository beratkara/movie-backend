<?php

namespace App\Services\ThirdParty\CollectApi;

use App\Events\MovieFetchedFromCache;
use App\Exceptions\ClientException;
use App\Models\Movie;
use App\Services\Connection\Guzzle\GuzzleClient;
use App\Services\ThirdParty\CollectApi\DTO\Data\ImdbShowData;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Throwable;

class ImdbApi extends GuzzleClient
{
    public function __construct(array $options)
    {
        parent::__construct($options);
        $this->setHeaders(config('services.imdb.headers'));
        $this->setOptions([
            'base_uri' => config('services.imdb.base_uri')
        ]);
        $this->init();
    }

    private function isCache($name)
    {
        if (Cache::has($name)) {
            $response = Cache::get($name);
            event(new MovieFetchedFromCache($name, (array)$response));
            return $response;
        }
        return null;
    }

    private function setCache($name, $data)
    {
        Cache::put($name, $data, Carbon::tomorrow());
    }

    /**
     * @throws Throwable
     */
    public function search($keyword): array
    {
        $cacheName = config('movie_services.cache_prefix.search').$keyword;
        $response = $this->isCache($cacheName) ?? $this->get('imdbSearchByName?query='.$keyword);
        $this->setCache($cacheName, $response);

        throw_unless($response->success, ClientException::class, $response->result['Error'] ?? 'Bir Hata Oluştu');

        return $response->result;
    }

    /**
     * @throws Throwable
     */
    public function show($id): array
    {
        $cacheName = config('movie_services.cache_prefix.show').$id;
        $response = $this->isCache($cacheName) ?? $this->get('imdbSearchById?movieId='.$id);
        $this->setCache($cacheName, $response);

        throw_unless($response->success, ClientException::class, $response->result['Error'] ?? 'Bir Hata Oluştu');

        $dtoData = ImdbShowData::fromApi($response->result);

        $this->checkMovie($id, $dtoData);

        return $response->result;
    }

    private function checkMovie($id, $dtoData)
    {
        Movie::query()->firstOrCreate([
            'service_id' => $id,
            'service_name' => 'imdb'
        ], [
            'name' => $dtoData->title
        ]);
    }
}
