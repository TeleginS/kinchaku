<?php

declare(strict_types=1);

namespace App\Article\Command\Upload;

final class Command
{
    public string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }
}
