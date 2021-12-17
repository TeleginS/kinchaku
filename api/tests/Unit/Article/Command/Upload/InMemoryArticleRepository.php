<?php

declare(strict_types=1);

namespace Tests\Unit\Article\Command\Upload;

use App\Article\Repository\ArticleRepositoryInterface;
use App\Models\Article;

class InMemoryArticleRepository implements ArticleRepositoryInterface
{
    private ?Article $article = null;

    public function save(Article $article): void
    {
        $this->article = $article;
    }

    public function get(int $id): Article
    {
        return $this->article;
    }

    public function existBySlug(string $slug): bool
    {
        return false;
    }
}
