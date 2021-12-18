<?php

declare(strict_types=1);

namespace App\Article\Query\Catalog;

use App\Article\Repository\ArticleRepositoryInterface;
use App\Models\Article;

class Fetcher
{
    private ArticleRepositoryInterface $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function fetch(Query $query): array
    {
        $result = [];

        $articlesPagination = $this->articleRepository->fetch($query);
        /**
         * @var Article[] $articles
         */
        $articles = $articlesPagination->items();

        foreach ($articles as $article) {
            $result[] = [
                "id" => $article->id,
                "title" => $article->title,
                "slug" => $article->slug,
                "content" => $article->getContent()->content,
                "categories" => $article->getCategories(),
                "media" => $article->getMedia(),
            ];
        }

        return ["success" => true, "articles" => $result, "total" => $articlesPagination->total()];
    }
}
