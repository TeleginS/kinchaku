<?php

declare(strict_types=1);

namespace App\Article\Repository;

use App\Models\ArticleCategory;

final class ArticleCategoryRepository implements
    ArticleCategoryRepositoryInterface
{
    public function save(ArticleCategory $articleContent): void
    {
        $articleContent->save();
    }
}
