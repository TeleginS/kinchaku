<?php

declare(strict_types=1);

namespace App\Http\Controllers\Article\Catalog;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Action extends BaseController
{
    public function __invoke(Request $request): JsonResponse
    {
        $data = $request->validated();

        return new JsonResponse([], Response::HTTP_OK);
    }
}
