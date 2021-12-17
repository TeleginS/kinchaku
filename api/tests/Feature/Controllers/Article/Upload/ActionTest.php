<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers\Article\Upload;


use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ActionTest extends TestCase
{
    protected function tearDown(): void
    {
        //Clear DB after uploading. Better use testing env
        Article::query()->truncate();
        Category::query()->truncate();
    }

    public function testUploadJsonInvalidError(): void
    {
        $file = UploadedFile::fake()->createWithContent("feed.json", "fdsfsfsfsf")->mimeType("application/json");

        $response = $this->call('POST', '/articles/upload', [], [], ['file' => $file], ['Accept' => 'application/json']);

        $response->assertStatus(404);
        $response->assertExactJson([
            "success" => false,
            "message" => "Json not valid",
        ]);
    }

    public function testUploadWrongJsonInFile(): void
    {
        $this->markTestIncomplete();
        $content = '[{"@link": "https:\/\/localhost\/","title": "Cosmology in crisis as evidence suggests our universe isn&#8217;t flat, it&#8217;s actually curved","slug": "test-article-handler"}]';

        $file = UploadedFile::fake()->createWithContent("feed.json", $content)->mimeType("application/json");

        $response = $this->call('POST', '/articles/upload', [], [], ['file' => $file], ['Accept' => 'application/json']);

        $response->assertStatus(404);
        $response->assertExactJson([
            "success" => false,
            "message" => "Common error message",
        ]);
    }

    public function testUploadSuccessfully(): void
    {
        $this->markTestIncomplete();
        $fileBasePath = base_path("tests/Fixture/feed.json");
        $data = file_get_contents($fileBasePath);
        $file = UploadedFile::fake()->createWithContent("feed.json", $data)->mimeType("application/json");

        $response = $this->call('POST', '/articles/upload', [], [], ['file' => $file], ['Accept' => 'application/json']);

        $response->assertStatus(200);
        $response->assertExactJson([
            "success" => true,
            "message" => "File uploaded",
        ]);
    }

    public function testTwoSameArticlesInFileShouldBeOneArticleInDatabase(): void
    {
        $this->markTestIncomplete();
        $fileBasePath = base_path("tests/Fixture/twoSameArticle.json");
        $data = file_get_contents($fileBasePath);
        $file = UploadedFile::fake()->createWithContent("feed.json", $data)->mimeType("application/json");

        $response = $this->call('POST', '/articles/upload', [], [], ['file' => $file], ['Accept' => 'application/json']);

        $response->assertStatus(200);
        $response->assertExactJson([
            "success" => true,
            "message" => "File uploaded",
        ]);

        $this->assertSame(1, Article::query()->count());
    }
}
