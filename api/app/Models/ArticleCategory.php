<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property Article $article
 * @property Category $category
 * @property bool $is_primary
 * @psalm-suppress PropertyNotSetInConstructor
 */
class ArticleCategory extends Model
{
    protected $table = "article_category";

    protected $casts = [
        "id" => "int",
        "is_primary" => "bool",
    ];

    protected $fillable = ["is_primary"];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->is_primary = false;
    }

    public static function new(bool $isPrimary): self
    {
        $articleCategory = new self();
        $articleCategory->is_primary = $isPrimary;

        return $articleCategory;
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class, "article_id");
    }

    public function associateArticle(Article $article): void
    {
        $this->article()->associate($article);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, "category_id");
    }

    public function associateCategory(Category $category): void
    {
        $this->category()->associate($category);
    }

    public function makePrimary(): void
    {
        $this->is_primary = true;
    }
}
