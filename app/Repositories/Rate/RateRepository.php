<?php

namespace App\Repositories\Rate;

use App\Contracts\RateRepositoryInterface;
use App\Events\RateCalculateEvent;
use App\Exceptions\ClientException;
use App\Helpers\ResponseMessageHelper;
use App\Models\Movie;
use App\Models\Rate;
use Illuminate\Support\Collection;

class RateRepository implements RateRepositoryInterface
{

    public function show(string $movieId)
    {
        return Rate::query()
            ->whereRelation('movie', 'service_id', $movieId)
            ->avg('rate');
    }

    public function store(Collection $attributes): ResponseMessageHelper
    {
        /** @var Movie $movie */
        $movie = Movie::query()->where('service_id', $attributes->get('movie_id'))->firstOrFail();

        $ipAddress = request()->ip();

        throw_if($movie->rates()->where('ip_address', $ipAddress)->count(), ClientException::class, 'Daha önce oy verilmiş');

        $movie->rates()->create([
            'ip_address' => $ipAddress,
            'rate' => $attributes->get('rate')
        ]);

        event(new RateCalculateEvent($movie->service_id));

        return ResponseMessageHelper::success('Oy verme işlemi başarı ile gerçekleşti.');
    }
}
