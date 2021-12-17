<?php

declare(strict_types=1);

namespace Tests\Unit\Article\Command\Upload;

use App\Article\Repository\ArticleMediaRepositoryInterface;
use App\Models\ArticleMedia;

class InMemoryArticleMediaRepository implements ArticleMediaRepositoryInterface
{
    private ?ArticleMedia $articleMedia = null;

    public function save(ArticleMedia $articleMedia): void
    {
        $this->articleMedia = $articleMedia;
    }

    public function get(int $id): ArticleMedia
    {
        return $this->articleMedia;
    }
}
