<?php

declare(strict_types=1);

namespace App\Http\Controllers\Category\Catalog;

use App\Article\Repository\CategoryRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Action extends BaseController
{
    public function __invoke(
        CategoryRepositoryInterface $categoryRepository
    ): JsonResponse {
        return new JsonResponse(
            [
                "success" => true,
                "categories" => $categoryRepository
                    ->all()
                    ->pluck("value", "id")
                    ->toArray(),
            ],
            Response::HTTP_OK
        );
    }
}
