<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int    $id
 * @property Article $article
 * @property string $link
 * @property string $type
 * @property string $url
 */
class ArticleMedia extends Model
{
    protected $table = "article_media";

    protected $casts = [
        "id" => "int",
    ];

    protected $fillable = ["link", "type", "url"];

    /**
     * @param string $link
     * @param string $type
     * @param string $url
     * @return ArticleMedia
     */
    public static function new(string $link, string $type, string $url): self
    {
        $articleMedia = new self();
        $articleMedia->link = $link;
        $articleMedia->type = $type;
        $articleMedia->url = $url;

        return $articleMedia;
    }


    protected function article(): BelongsTo
    {
        return $this->belongsTo(Article::class, "article_id");
    }

    public function associateArticle(Article $article): void
    {
        $this->article()->associate($article);
    }
}
