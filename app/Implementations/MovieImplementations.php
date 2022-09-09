<?php

namespace App\Implementations;

use App\Contracts\MovieRepositoryInterface;
use App\Services\Movie\MovieService;

class MovieImplementations implements MovieService
{
    protected MovieRepositoryInterface $movieRepository;

    public function __construct(MovieRepositoryInterface $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function searchMovie($keyword)
    {
        return $this->movieRepository->searchMovie($keyword);
    }

    public function getMovieById($movieId)
    {
        return $this->movieRepository->getMovieById($movieId);
    }
}
