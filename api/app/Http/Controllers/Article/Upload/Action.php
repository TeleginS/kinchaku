<?php

declare(strict_types=1);

namespace App\Http\Controllers\Article\Upload;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Action extends BaseController
{
    public function __invoke(Request $request): JsonResponse {
        /**
         * @var array{file:UploadedFile} $validatedData
         */
        $validatedData = $request->validated();

        return new JsonResponse(
            [
                "success" => true,
                "message" => "File uploaded",
            ],
            Response::HTTP_OK
        );
    }
}
