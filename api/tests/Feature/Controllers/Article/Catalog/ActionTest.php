<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers\Article\Catalog;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ActionTest extends TestCase
{
    public function testEmptyResult()
    {
        $this->markTestIncomplete();
        //Clear DB after uploading. Better use testing env
        Article::query()->truncate();
        Category::query()->truncate();

        $response = $this->get("/articles?page=1&perPage=5");

        $response->assertStatus(200);
        $response->assertExactJson([
            "success" => true,
            "articles" => [],
            "total" => 0,
        ]);
    }

    public function test2ArticlesInFeed()
    {
        $this->markTestIncomplete();
        $fileBasePath = base_path("tests/Fixture/feed.json");
        $data = file_get_contents($fileBasePath);
        $file = UploadedFile::fake()->createWithContent("feed.json", $data)->mimeType("application/json");
        $this->call('POST', '/articles/upload', [], [], ['file' => $file], ['Accept' => 'application/json']);

        $response = $this->get("/articles?page=1&perPage=2");

        $response->assertStatus(200);
        $response->assertJsonFragment([
            "success" => true,
            "total" => 200,
        ]);
        $response->assertJsonCount(2, "articles");
        $this->assertStringContainsString("Cosmology in crisis as evidence suggests", $response->json("articles")[0]["title"]);
        $this->assertStringContainsString("cosmology-in-crisis-as-evidence-suggests", $response->json("articles")[0]["slug"]);
        $this->assertStringContainsString("<p>No matter how elegant your theory is, experimental data will have the", $response->json("articles")[0]["content"]);

        Article::query()->truncate();
        Category::query()->truncate();
    }

    public function testSearchFilter()
    {
        $this->markTestIncomplete();
        $fileBasePath = base_path("tests/Fixture/feed.json");
        $data = file_get_contents($fileBasePath);
        $file = UploadedFile::fake()->createWithContent("feed.json", $data)->mimeType("application/json");
        $this->call('POST', '/articles/upload', [], [], ['file' => $file], ['Accept' => 'application/json']);

        $response = $this->get("/articles?page=1&perPage=10&search=Cosmology");

        $response->assertStatus(200);
        $response->assertJsonFragment([
            "success" => true,
            "total" => 1,
        ]);
        $response->assertJsonCount(1, "articles");
        $this->assertStringContainsString("Cosmology in crisis as evidence suggests", $response->json("articles")[0]["title"]);
        $this->assertStringContainsString("cosmology-in-crisis-as-evidence-suggests", $response->json("articles")[0]["slug"]);
        $this->assertStringContainsString("<p>No matter how elegant your theory is, experimental data will have the", $response->json("articles")[0]["content"]);

        Article::query()->truncate();
        Category::query()->truncate();
    }

    public function testCategoryFilter()
    {
        $this->markTestIncomplete();
        $fileBasePath = base_path("tests/Fixture/feed.json");
        $data = file_get_contents($fileBasePath);
        $file = UploadedFile::fake()->createWithContent("feed.json", $data)->mimeType("application/json");
        $this->call('POST', '/articles/upload', [], [], ['file' => $file], ['Accept' => 'application/json']);

        $response = $this->get("/articles?page=1&perPage=10&category=43");

        $response->assertStatus(200);
        $response->assertJsonFragment([
            "success" => true,
            "total" => 1,
        ]);
        $response->assertJsonCount(1, "articles");
        $this->assertStringContainsString("Robinhood users are really bad", $response->json("articles")[0]["title"]);
        $this->assertStringContainsString("data-robinhood-users-are-really-bad-at-portfolio-diversification", $response->json("articles")[0]["slug"]);
        $this->assertStringContainsString("At the start of November, we downloaded the full", $response->json("articles")[0]["content"]);

        Article::query()->truncate();
        Category::query()->truncate();
    }

    public function testSearchCategoryFilter()
    {
        $this->markTestIncomplete();
        $fileBasePath = base_path("tests/Fixture/feed.json");
        $data = file_get_contents($fileBasePath);
        $file = UploadedFile::fake()->createWithContent("feed.json", $data)->mimeType("application/json");
        $this->call('POST', '/articles/upload', [], [], ['file' => $file], ['Accept' => 'application/json']);

        $response = $this->get("/articles?page=1&perPage=10&search=lolosdfddfs&category=43");

        $response->assertStatus(200);
        $response->assertJsonFragment([
            "success" => true,
            "total" => 1,
        ]);
        $response->assertJsonCount(1, "articles");
        $this->assertStringContainsString("Robinhood users are really bad", $response->json("articles")[0]["title"]);
        $this->assertStringContainsString("data-robinhood-users-are-really-bad-at-portfolio-diversification", $response->json("articles")[0]["slug"]);
        $this->assertStringContainsString("At the start of November, we downloaded the full", $response->json("articles")[0]["content"]);

        Article::query()->truncate();
        Category::query()->truncate();
    }
}
