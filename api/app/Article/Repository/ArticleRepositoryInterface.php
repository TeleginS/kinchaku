<?php

declare(strict_types=1);

namespace App\Article\Repository;

use App\Article\Query\Catalog\Query;
use App\Models\Article;
use Illuminate\Pagination\LengthAwarePaginator;

interface ArticleRepositoryInterface
{
    public function fetch(Query $filter): LengthAwarePaginator;

    public function save(Article $article): void;

    public function existBySlug(string $slug): bool;
}
