<?php

declare(strict_types=1);

namespace App\Article\Query\Catalog;

class Query
{
    public ?string $search;
    public ?int $category;
    public int $page;
    public int $perPage;

    public function __construct(
        int $page,
        int $perPage,
        ?string $search,
        ?int $category
    ) {
        $this->search = $search;
        $this->category = $category;
        $this->page = $page;
        $this->perPage = $perPage;
    }
}
