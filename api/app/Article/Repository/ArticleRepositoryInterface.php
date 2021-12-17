<?php

declare(strict_types=1);

namespace App\Article\Repository;

use App\Models\Article;

interface ArticleRepositoryInterface
{
    public function save(Article $article): void;

    public function existBySlug(string $slug): bool;
}
