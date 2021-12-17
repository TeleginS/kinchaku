<?php

declare(strict_types=1);

namespace App\Article\Repository;

use App\Models\ArticleCategory;

interface ArticleCategoryRepositoryInterface
{
    public function save(ArticleCategory $articleContent): void;
}
