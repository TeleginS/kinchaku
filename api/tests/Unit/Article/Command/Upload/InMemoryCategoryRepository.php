<?php

declare(strict_types=1);

namespace Tests\Unit\Article\Command\Upload;

use App\Article\Repository\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Support\Collection;

class InMemoryCategoryRepository implements CategoryRepositoryInterface
{
    protected ?Category $category = null;

    public function all(): Collection
    {
        return collect($this->category);
    }

    public function firstOrNew(string $categoryName): Category
    {
        $category = new Category();
        $category->value = $categoryName;
        $category->id = 1;
        $this->category = $category;
        return $this->category;
    }

    public function get(int $categoryId): Category
    {
        return $this->category;
    }

    public function save(Category $category): void
    {
        $this->category = $category;
    }
}
