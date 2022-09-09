<?php

namespace App\Services\ThirdParty\CollectApi\DTO\Data;

use App\Models\Movie;
use Spatie\DataTransferObject\DataTransferObject;

class ImdbData extends DataTransferObject
{
    public string $id;
    public string $title;
    public ?string $year;
    public string $type;
    public ?string $poster;
    public string $url;
    public ?float $rate;

    public static function fromApi($data): ImdbData
    {
        foreach ($data as &$item) {
            if ($item === 'N/A') {
                $item = null;
            }
        }

        $movie = Movie::query()->where('service_id', $data['imdbID'])->first();

        return new static([
            'id' => $data['imdbID'],
            'title' => $data['Title'],
            'year' => $data['Year'],
            'type' => $data['Type'],
            'poster' => $data['Poster'],
            'url' => 'https://www.imdb.com/title/'.$data['imdbID'],
            'rate' => $movie->average ?? null,
        ]);
    }
}
