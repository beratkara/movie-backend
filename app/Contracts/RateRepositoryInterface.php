<?php

namespace App\Contracts;

use App\Helpers\ResponseMessageHelper;
use Illuminate\Support\Collection;

interface RateRepositoryInterface
{
    public function show(string $movieId);
    public function store(Collection $attributes): ResponseMessageHelper;
}
