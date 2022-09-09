<?php

namespace App\Services\Movie;

interface MovieService
{
    public function searchMovie($keyword);
    public function getMovieById($movieId);
}
