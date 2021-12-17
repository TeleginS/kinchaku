<?php

declare(strict_types=1);

namespace Tests\Unit\Article\Command\Upload;

use App\Article\Command\Upload\Command;
use App\Article\Command\Upload\Handler;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * @covers Handler
 */
class HandlerTest extends TestCase
{
    public function testArticleCreatedSuccessfully(): void
    {
        $fileName = "upload.json";
        $fileBasePath = base_path("tests/Fixture/article.json");
        $data = file_get_contents($fileBasePath);
        Storage::disk("local")->put($fileName, $data);

        $categoryRepository = new InMemoryCategoryRepository();
        $articleRepository = new InMemoryArticleRepository();
        $articleContentRepository = new InMemoryArticleContentRepository();
        $articleCategoryRepository = new InMemoryArticleCategoryRepository();
        $articleMediaRepository = new InMemoryArticleMediaRepository();

        $handler = new Handler(
            $articleRepository,
            $articleMediaRepository,
            $articleContentRepository,
            $articleCategoryRepository,
            $categoryRepository
        );
        ($handler)(new Command($fileName));

        $category = $categoryRepository->get(1);
        $this->assertSame("testCategory", $category->value);
        $this->assertSame(1, $category->id);

        $article = $articleRepository->get(1);
        $this->assertStringContainsString("Cosmology in crisis as evidence", $article->title);
        $this->assertSame("test-article-handler", $article->slug);

        $articleContent = $articleContentRepository->get(1);
        $this->assertSame("html", $articleContent->type);
        $this->assertStringContainsString("<p>No matter how elegant your theory is, experimental data will have the last word. Observations", $articleContent->content);

        $this->assertSame($article, $articleContent->article);

        $articleMedia = $articleMediaRepository->get(1);
        $this->assertSame("medialink", $articleMedia->link);
        $this->assertSame("featured", $articleMedia->type);
        $this->assertSame("mediaurl", $articleMedia->url);

        $this->assertSame($article, $articleMedia->article);

        $articleCategory = $articleCategoryRepository->get(1);
        $this->assertSame($article, $articleCategory->article);
        $this->assertSame($category, $articleCategory->category);
    }
}
