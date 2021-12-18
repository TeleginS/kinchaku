<?php

declare(strict_types=1);

namespace App\Http\Controllers\Article\Catalog;

use App\Article\Query\Catalog\Fetcher;
use App\Article\Query\Catalog\Query;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Action extends BaseController
{
    public function __invoke(Request $request, Fetcher $fetcher): JsonResponse
    {
        $data = $request->validated();

        $query = new Query(
            (int) $data["page"],
            (int) $data["perPage"],
            isset($data["search"]) ? (string) $data["search"] : null,
            isset($data["category"]) ? (int) $data["category"] : null
        );

        $result = $fetcher->fetch($query);

        return new JsonResponse($result, Response::HTTP_OK);
    }
}
