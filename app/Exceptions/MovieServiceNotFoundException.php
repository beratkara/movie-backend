<?php

namespace App\Exceptions;

use App\Helpers\ResponseMessageHelper;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class MovieServiceNotFoundException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function render(Request $request): JsonResponse
    {
        return response()->json(ResponseMessageHelper::error($this->getMessage()), ResponseAlias::HTTP_BAD_REQUEST);
    }
}
