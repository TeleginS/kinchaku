<?php

declare(strict_types=1);

namespace App\Article\Repository;

use App\Models\ArticleMedia;

final class ArticleMediaRepository implements ArticleMediaRepositoryInterface
{
    public function save(ArticleMedia $articleMedia): void
    {
        $articleMedia->save();
    }
}
