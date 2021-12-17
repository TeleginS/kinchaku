<?php

declare(strict_types=1);

namespace Tests\Unit\Article\Command\Upload;

use App\Article\Repository\ArticleCategoryRepositoryInterface;
use App\Models\ArticleCategory;

class InMemoryArticleCategoryRepository implements ArticleCategoryRepositoryInterface
{
    private ?ArticleCategory $articleContent = null;

    public function save(ArticleCategory $articleContent): void
    {
        $this->articleContent = $articleContent;
    }

    public function get(int $id): ArticleCategory
    {
        return $this->articleContent;
    }
}
