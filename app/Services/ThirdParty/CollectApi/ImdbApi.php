<?php

namespace App\Services\ThirdParty\CollectApi;

use App\Events\MovieFetchedFromCache;
use App\Exceptions\ClientException;
use App\Models\Movie;
use App\Services\GuzzleClient;
use App\Services\ThirdParty\CollectApi\DTO\Collection\ImdbCollection;
use App\Services\ThirdParty\CollectApi\DTO\Data\ImdbShowData;
use App\Services\ThirdParty\CollectApi\DTO\ImdbDto;
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

    public function search($keyword): array
    {
        $response = $this->isCache('Search-'.$keyword) ?? $this->get('imdbSearchByName?query='.$keyword);
        $this->setCache('Search-'.$keyword, $response);

        throw_unless($response->success, ClientException::class, $response->result['Error'] ?? 'Bir Hata Oluştu');

        $data = new ImdbDto([
            'data' => ImdbCollection::fromArray($response->result),
        ]);
        return $data->toArray();
    }

    /**
     * @throws Throwable
     */
    public function show($id): array
    {
        $response = $this->isCache('Movie-'.$id) ?? $this->get('imdbSearchById?movieId='.$id);
        $this->setCache('Movie-'.$id, $response);

        throw_unless($response->success, ClientException::class, $response->result['Error'] ?? 'Bir Hata Oluştu');

        $dtoData = ImdbShowData::fromApi($response->result);

        $this->checkMovie($id, $dtoData);

        $data = new ImdbDto([
            'data' => $dtoData,
        ]);
        return $data->toArray();
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
