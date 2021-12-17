<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property Collection<Article> $articles
 * @property string $value
 *
 * @method Category firstOrNew($value)
 */
class Category extends Model
{
    public $timestamps = false;

    protected $table = "category";

    protected $casts = [
        "id" => "int",
    ];

    protected $fillable = ["value"];

    /**
     * @return BelongsToMany<Article>
     */
    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(
            Article::class,
            "article_category",
            "category_id",
            "article_id"
        )->withPivot(["is_primary"]);
    }

    /**
     * @return Collection<Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }
}
