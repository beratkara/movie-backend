<?php

namespace App\Http\Controllers\Api;

use App\Contracts\RateRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RateStoreRequest;
use App\Http\Resources\Api\RateResource;
use Illuminate\Http\JsonResponse;

class RateController extends Controller
{
    /** @var RateRepositoryInterface */
    public RateRepositoryInterface $rateRepository;

    public function __construct(RateRepositoryInterface $rateRepository)
    {
        $this->rateRepository = $rateRepository;
    }

    public function show($movieId): RateResource
    {
        return RateResource::make($this->rateRepository->show($movieId));
    }

    public function store(RateStoreRequest $request): JsonResponse
    {
        $attributes = collect($request->validated());

        return response()->json($this->rateRepository->store($attributes));
    }
}
