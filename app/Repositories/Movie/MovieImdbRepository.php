<?php

namespace App\Repositories\Movie;

use App\Contracts\MovieRepositoryInterface;
use App\Services\Connection\Guzzle\GuzzleClient;

class MovieImdbRepository implements MovieRepositoryInterface
{
    private GuzzleClient $client;

    public function __construct(GuzzleClient $client)
    {
        $this->client = $client;
    }

    public function searchMovie($keyword)
    {
        return $this->client->search($keyword);
    }

    public function getMovieById($movieId)
    {
        return $this->client->show($movieId);
    }
}
