<?php

namespace App\Contracts;

interface MovieRepositoryInterface
{
    public function searchMovie($keyword);
    public function getMovieById($movieId);
}
