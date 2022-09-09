<?php

namespace App\Repositories\Movie;

use App\Contracts\MovieRepositoryInterface;
use App\Services\GuzzleClient;

class MovieImdbRepository implements MovieRepositoryInterface
{
    /** @var GuzzleClient  */
    private $client;

    public function __construct()
    {
        $this->client = app(GuzzleClient::class);
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
