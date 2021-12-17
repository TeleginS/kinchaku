<?php

declare(strict_types=1);

namespace App\Article\Repository;

use App\Models\ArticleContent;

interface ArticleContentRepositoryInterface
{
    public function save(ArticleContent $articleContent): void;
}
