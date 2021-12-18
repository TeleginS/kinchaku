<?php

namespace App\Providers;

use App\Article\Repository\ArticleCategoryRepository;
use App\Article\Repository\ArticleCategoryRepositoryInterface;
use App\Article\Repository\ArticleContentRepository;
use App\Article\Repository\ArticleContentRepositoryInterface;
use App\Article\Repository\ArticleMediaRepository;
use App\Article\Repository\ArticleMediaRepositoryInterface;
use App\Article\Repository\ArticleRepository;
use App\Article\Repository\ArticleRepositoryInterface;
use App\Article\Repository\CategoryRepository;
use App\Article\Repository\CategoryRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /** @var array<interface-string, class-string> */
    public array $bindings = [
        CategoryRepositoryInterface::class => CategoryRepository::class,
        ArticleRepositoryInterface::class => ArticleRepository::class,
        ArticleMediaRepositoryInterface::class => ArticleMediaRepository::class,
        ArticleContentRepositoryInterface::class =>
            ArticleContentRepository::class,
        ArticleCategoryRepositoryInterface::class =>
            ArticleCategoryRepository::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
