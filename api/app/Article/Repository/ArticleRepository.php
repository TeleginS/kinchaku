<?php

declare(strict_types=1);

namespace App\Article\Repository;

use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

final class ArticleRepository implements ArticleRepositoryInterface
{
    public function fetch(Query $filter): LengthAwarePaginator
    {
        // TODO: Implement fetch() method.
    }

    /**
     * @psalm-return Builder<Article>
     *
     * @return Builder|Article
     */
    private function getBuilder(): Builder
    {
        return Article::query();
    }

    public function save(Article $article): void
    {
        $article->save();
    }

    public function existBySlug(string $slug): bool
    {
        return $this->getBuilder()
            ->where("slug", "=", $slug)
            ->exists();
    }
}
