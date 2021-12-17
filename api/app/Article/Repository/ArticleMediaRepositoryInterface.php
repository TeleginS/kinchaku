<?php

declare(strict_types=1);

namespace App\Article\Repository;

use App\Models\ArticleMedia;

interface ArticleMediaRepositoryInterface
{
    public function save(ArticleMedia $articleMedia): void;
}
