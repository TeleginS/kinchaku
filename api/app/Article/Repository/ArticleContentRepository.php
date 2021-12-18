<?php

declare(strict_types=1);

namespace App\Article\Repository;

use App\Models\ArticleContent;

final class ArticleContentRepository implements
    ArticleContentRepositoryInterface
{
    public function save(ArticleContent $articleContent): void
    {
        $articleContent->save();
    }
}
