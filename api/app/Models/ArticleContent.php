<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int    $id
 * @property string $type
 * @property string $content
 * @property Article $article
 */
class ArticleContent extends Model
{
    protected $table = "article_content";

    protected $casts = [
        "id" => "int",
    ];

    protected $fillable = ["type", "content"];

    /**
     * @param string $type
     * @param string $content
     * @return ArticleContent
     */
    public static function new(string $type, string $content): self
    {
        $articleContent = new self();
        $articleContent->type = $type;
        $articleContent->content = $content;

        return $articleContent;
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class, "article_id");
    }

    public function associateArticle(Article $article): void
    {
        $this->article()->associate($article);
    }
}
