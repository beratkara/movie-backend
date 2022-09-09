<?php

use App\Repositories\Movie\MovieCacheRepository;
use App\Repositories\Movie\MovieImdbRepository;

return [
    'services' => [
        'collect_api' => MovieImdbRepository::class,
        'cache' => MovieCacheRepository::class
    ]
];
