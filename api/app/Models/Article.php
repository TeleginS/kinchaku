<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

/**
 * @property int    $id
 * @property string $title
 * @property string $slug
 * @property ArticleContent $content
 * @property Collection<Category> $categories
 * @property ArticleMedia $media
 */
class Article extends Model
{
    protected $table = "article";

    protected $casts = [
        "id" => "int",
    ];

    protected $fillable = ["title", "slug"];

    /**
     * @param string $title
     * @param string $slug
     * @return Article
     */
    public static function new(string $title, string $slug): self
    {
        $article = new self();
        $article->title = $title;
        $article->slug = $slug;

        return $article;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): ArticleContent
    {
        return $this->content;
    }

    public function content(): HasOne
    {
        return $this->hasOne(ArticleContent::class);
    }

    public function media(): HasOne
    {
        return $this->hasOne(ArticleMedia::class);
    }

    public function getMedia(): ?ArticleMedia
    {
        return $this->media;
    }

    /**
     * @return BelongsToMany<Category>
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            "article_category",
            "article_id",
            "category_id"
        )->withPivot(["is_primary"]);
    }

    /** @param Category[]|iterable|Collection $categories */
    public function addCategories(iterable $categories): void
    {
        $this->categories()
            ->saveMany($categories);
    }

    /** @return array */
    public function getCategories(): array
    {
        return $this->categories
            ->sortByDesc("pivot.is_primary")
            ->pluck("value")
            ->toArray();
    }
}
