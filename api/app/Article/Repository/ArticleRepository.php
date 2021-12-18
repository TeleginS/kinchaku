<?php

declare(strict_types=1);

namespace App\Article\Repository;

use App\Article\Query\Catalog\Query;
use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

final class ArticleRepository implements ArticleRepositoryInterface
{
    public function fetch(Query $filter): LengthAwarePaginator
    {
        $query = $this->getBuilder();

        if (null !== $filter->search) {
            $query
                ->where("title", "like", "%{$filter->search}%")
                ->orwhereHas("content", function (Builder $q) use (
                    $filter
                ): void {
                    $q->where("content", "like", "%{$filter->search}%");
                });
        }

        if (null !== $filter->category) {
            $query->orwhereHas("categories", function (Builder $q) use (
                $filter
            ): void {
                $q->where("category_id", "=", $filter->category);
            });
        }

        return $query->paginate($filter->perPage, ["*"], "page", $filter->page);
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
