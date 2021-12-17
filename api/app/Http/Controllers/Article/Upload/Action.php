<?php

declare(strict_types=1);

namespace App\Http\Controllers\Article\Upload;

use App\Article\Command\Upload\Command;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Log\Logger;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Joselfonseca\LaravelTactician\CommandBusInterface;
use Symfony\Component\HttpFoundation\Response;

class Action extends BaseController
{
    public function __invoke(
        Request $request,
        CommandBusInterface $commandBus,
        Logger $logger
    ): JsonResponse {
        /**
         * @var array{file:UploadedFile} $validatedData
         */
        $validatedData = $request->validated();

        /** @var array|null $articles */
        $articles = json_decode($validatedData["file"]->getContent());
        if (null === $articles) {
            return new JsonResponse(
                [
                    "success" => false,
                    "message" => "Json not valid",
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        $filePath = "upload.json";
        Storage::disk("local")->put(
            $filePath,
            $validatedData["file"]->getContent()
        );

        try {
            $commandBus->dispatch(new Command($filePath));
        } catch (\Throwable $e) {
            //Here we can add Sentry or other logger service
            $logger->error($e->getMessage());

            return new JsonResponse(
                [
                    "success" => false,
                    "message" => "Common error message",
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        return new JsonResponse(
            [
                "success" => true,
                "message" => "File uploaded",
            ],
            Response::HTTP_OK
        );
    }
}
