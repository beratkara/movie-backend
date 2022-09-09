<?php

namespace App\Services\ThirdParty\CollectApi\DTO\Data;

use App\Models\Movie;
use Spatie\DataTransferObject\DataTransferObject;

class ImdbShowData extends DataTransferObject
{
    public string $id;
    public string $title;
    public ?string $year;
    public string $type;
    public ?string $poster;
    public ?array $country;
    public ?array $languages;
    public ?array $actors;
    public ?string $duration;
    public ?string $rated;
    public string $url;
    public ?float $rate;

    public static function fromApi($data): ImdbShowData
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
            'country' => explode(', ', $data['Country']),
            'languages' => explode(', ', $data['Language']),
            'actors' => explode(', ', $data['Actors']),
            'duration' => $data['Runtime'],
            'rated' => $data['Rated'],
            'url' => 'https://www.imdb.com/title/'.$data['imdbID'],
            'rate' => $movie->average ?? null,
        ]);
    }
}
