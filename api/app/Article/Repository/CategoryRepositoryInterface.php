<?php

declare(strict_types=1);

namespace App\Article\Repository;

use App\Models\Category;
use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
    /**
     * @return Collection<Category>
     */
    public function all(): Collection;

    /**
     * @param string $categoryName
     */
    public function firstOrNew(string $categoryName): Category;

    /**
     * @param int $categoryId
     * @return Category
     */
    public function get(int $categoryId): Category;

    /**
     * @param Category $category
     */
    public function save(Category $category): void;
}
