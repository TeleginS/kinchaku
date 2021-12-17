<?php

declare(strict_types=1);

namespace App\Article\Command\Upload;

use App\Article\Repository\ArticleCategoryRepositoryInterface;
use App\Article\Repository\ArticleContentRepositoryInterface;
use App\Article\Repository\ArticleMediaRepositoryInterface;
use App\Article\Repository\ArticleRepositoryInterface;
use App\Article\Repository\CategoryRepositoryInterface;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleContent;
use App\Models\ArticleMedia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

final class Handler
{
    private CategoryRepositoryInterface $categoryRepository;
    private ArticleRepositoryInterface $articleRepository;
    private ArticleMediaRepositoryInterface $articleMediaRepository;
    private ArticleContentRepositoryInterface $articleContentRepository;
    private ArticleCategoryRepositoryInterface $articleCategoryRepository;

    public function __construct(
        ArticleRepositoryInterface $articleRepository,
        ArticleMediaRepositoryInterface $articleMediaRepository,
        ArticleContentRepositoryInterface $articleContentRepository,
        ArticleCategoryRepositoryInterface $articleCategoryRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->articleRepository = $articleRepository;
        $this->articleMediaRepository = $articleMediaRepository;
        $this->articleContentRepository = $articleContentRepository;
        $this->categoryRepository = $categoryRepository;
        $this->articleCategoryRepository = $articleCategoryRepository;
    }

    public function __invoke(Command $command): void
    {
        if (!Storage::disk("local")->exists($command->filePath)) {
            throw new ArticleFileNotExistException();
        }

        $file = Storage::disk("local")->get($command->filePath);
        /** @psalm-var list<object{@link: string, slug:string, content:list<object{type:string, content:string}>, categories:object{primary:string|null, additional:list<string>}, media:list<object{type:string, media:object{@link:string, attributes:object{url: string}}}>}> */
        $articles = json_decode($file);

        $con = DB::connection();
        $con->beginTransaction();
        try {
            foreach ($articles as $value) {
                if ($this->articleRepository->existBySlug($value->slug)) {
                    //Ignore article with not unique slug
                    continue;
                }
                $article = Article::new($value->title, $value->slug);
                $this->articleRepository->save($article);

                $categories = $value->categories;

                if (
                    null !== $categories->primary &&
                    "" !== $categories->primary
                ) {
                    $this->createArticleCategory(
                        (string)$categories->primary,
                        $article,
                        true
                    );
                }

                foreach ($categories->additional as $category) {
                    $this->createArticleCategory($category, $article);
                }

                foreach ($value->media as $m) {
                    if ($m->type === "featured") {
                        $articleMedia = ArticleMedia::new($m->media->{'@link'}, $m->type, $m->media->attributes->url);
                        $articleMedia->associateArticle($article);
                        $this->articleMediaRepository->save($articleMedia);
                        break;
                    }
                }

                $content = $value->content[0];
                $articleContent = ArticleContent::new($content->type, $content->content);
                $articleContent->associateArticle($article);
                $this->articleContentRepository->save($articleContent);
            }
        } catch (Throwable $e) {
            $con->rollBack();
            throw $e;
        }

        $con->commit();

        Storage::disk("local")->delete($command->filePath);
    }

    private function createArticleCategory(
        string $value,
        Article $article,
        ?bool $isPrimary = false
    ): void {
        $category = $this->categoryRepository->firstOrNew($value);
        $articleCategory = ArticleCategory::new($isPrimary);
        $articleCategory->associateCategory($category);
        $articleCategory->associateArticle($article);
        $this->articleCategoryRepository->save($articleCategory);
    }
}
