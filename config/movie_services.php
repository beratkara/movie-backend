<?php

use App\Repositories\Movie\MovieCacheRepository;
use App\Repositories\Movie\MovieImdbRepository;

return [
    'services' => [
        'collect-api' => MovieImdbRepository::class,
        'cache' => MovieCacheRepository::class
    ],

    'cache_prefix' => [
        'search' => 'Search-',
        'show' => 'Movie-',
    ]
];
