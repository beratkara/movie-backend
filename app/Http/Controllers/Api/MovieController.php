<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MovieServiceRequest;
use App\Services\Movie\MovieService;
use Illuminate\Http\JsonResponse;

class MovieController extends Controller
{
    /** @var MovieService */
    private MovieService $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function index(MovieServiceRequest $request): JsonResponse
    {
        $attributes = collect($request->validated());

        $keyword = $attributes->get('keyword');

        return response()->json($this->movieService->searchMovie($keyword));
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->movieService->getMovieById($id));
    }

}
