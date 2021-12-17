<?php

declare(strict_types=1);

namespace App\Article\Repository;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

final class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * @return Collection<Category>
     */
    public function all(): Collection
    {
        return $this->getBuilder()->get();
    }

    /**
     * @param string $categoryName
     * @psalm-suppress InvalidReturnType need  create PR into macroactive/laravel-psalm
     * @psalm-suppress InvalidReturnStatement
     */
    public function firstOrNew(string $categoryName): Category
    {
        $category = $this->getBuilder()
            ->where("value", "=", $categoryName)
            ->firstOrNew(["value" => $categoryName]);
        $category->save();
        return $category;
    }

    /**
     * @param int $categoryId
     * @return Category
     */
    public function get(int $categoryId): Category
    {
        return $this->getBuilder()
            ->where("id", "=", $categoryId)
            ->firstOrFail();
    }

    /**
     * @psalm-return Builder<Category>
     *
     * @return Builder|Category
     */
    private function getBuilder(): Builder
    {
        return Category::query();
    }

    public function save(Category $category): void
    {
        $category->save();
    }
}
