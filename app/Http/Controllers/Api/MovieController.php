<?php

namespace App\Http\Controllers\Api;

use App\Contracts\MovieServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MovieServiceRequest;
use App\Http\Resources\Api\MovieResource;
use App\Services\ThirdParty\CollectApi\DTO\Collection\ImdbCollection;
use App\Services\ThirdParty\CollectApi\DTO\Data\ImdbShowData;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MovieController extends Controller
{
    /** @var MovieServiceInterface */
    private MovieServiceInterface $movieService;

    public function __construct(MovieServiceInterface $movieService)
    {
        $this->movieService = $movieService;
    }

    public function index(MovieServiceRequest $request, $service): AnonymousResourceCollection
    {
        $attributes = collect($request->validated());

        $keyword = $attributes->get('keyword');

        $service = $this->movieService->make($service);
        $serviceData = $service->searchMovie($keyword);

        $movies = ImdbCollection::fromArray($serviceData)->toArray();

        return MovieResource::collection($movies);
    }

    public function show($service, $id): MovieResource
    {
        $service = $this->movieService->make($service);
        $serviceData = $service->getMovieById($id);

        $movie = ImdbShowData::fromApi($serviceData)->toArray();

        return MovieResource::make($movie);
    }

}
