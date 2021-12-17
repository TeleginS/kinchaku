<?php

declare(strict_types=1);

namespace Feature\Controllers\Category\Catalog;

use App\Models\Article;
use App\Models\Category;
use Tests\TestCase;

class ActionTest extends TestCase
{
    protected function tearDown(): void
    {
        //Clear DB after uploading. Better use testing env
        Article::query()->truncate();
        Category::query()->truncate();
    }

    public function testEmptyResult(): void
    {
        $this->markTestIncomplete();
        $response = $this->get("/categories/");

        $response->assertStatus(200);
        $response->assertExactJson([
            "success" => true,
            "categories" => [],
        ]);
    }

    public function testResultWithCategories(): void
    {
        $this->markTestIncomplete();
        foreach (["val1", "val2", "val3"] as $val) {
            $cat = new Category();
            $cat->value = $val;
            $cat->save();
        }

        $response = $this->get("/categories/");
        $response->assertStatus(200);
        $response->assertExactJson([
            "success" => true,
            "categories" => [
                1 => "val1",
                2 => "val2",
                3 => "val3",
            ],
        ]);
    }
}
