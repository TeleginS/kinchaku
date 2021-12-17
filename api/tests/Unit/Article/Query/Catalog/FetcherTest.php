<?php

declare(strict_types=1);

namespace Tests\Unit\Article\Query\Catalog;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleContent;
use App\Models\ArticleMedia;
use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Article\Command\Upload\InMemoryArticleRepository;

/**
 * @covers Fetcher
 */
class FetcherTest extends TestCase
{
    public function testSuccess(): void
    {
        $this->markTestIncomplete();
        $article = Article::new("title", "slug");
        $article->id = 1;
        $article->content = ArticleContent::new("type", "content");
        $category = new Category();
        $category->id = 1;
        $category->value = "categoryvalue";
        $articleCategory = ArticleCategory::new(true);
        $articleCategory->category = $category;
        $article->categories = new Collection([$articleCategory]);
        $media = ArticleMedia::new("link","type", "url");
        $article->media = $media;

        $lengthAwarePaginator = $this->createMock(LengthAwarePaginator::class);
        $lengthAwarePaginator->expects($this->once())
            ->method('items')
            ->willReturn([$article]);
        $lengthAwarePaginator->expects($this->once())
            ->method('total')
            ->willReturn(1);

        $articleRepository = $this->createMock(InMemoryArticleRepository::class);
        $articleRepository->expects($this->once())
            ->method('fetch')
            ->willReturn($lengthAwarePaginator);
        $fetcher = new Fetcher($articleRepository);
        $res = $fetcher->fetch(new Query(1,1, null, null));

        $articleRes = $res["articles"][0];

        $this->assertSame(1, $articleRes["id"]);
        $this->assertSame("title", $articleRes["title"]);
        $this->assertSame("slug", $articleRes["slug"]);
    }
}
