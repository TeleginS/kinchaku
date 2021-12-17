<?php

declare(strict_types=1);

namespace Tests\Unit\Article\Command\Upload;

use App\Article\Repository\ArticleContentRepositoryInterface;
use App\Models\ArticleContent;

class InMemoryArticleContentRepository implements ArticleContentRepositoryInterface
{
    private ?ArticleContent $articleContent = null;

    public function save(ArticleContent $articleContent): void
    {
        $this->articleContent = $articleContent;
    }

    public function get(int $id): ArticleContent
    {
        return $this->articleContent;
    }
}
