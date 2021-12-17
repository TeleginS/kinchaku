<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Articles extends Migration
{
    public function up(): void
    {
        Schema::create("article", function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("title");
            $table->string("slug")->unique();
            $table->timestamps();
            $table->index('title');
        });

        Schema::create("category", function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("value")->nullable(false)->unique();
            $table->index('value');
        });

        Schema::create("article_content", function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('article_id')->unique();
            $table->string("type");
            $table->text("content");
            $table->timestamps();
            $table->foreign('article_id')
                ->references('id')
                ->on('article')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::create("article_media", function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('article_id')->unique();
            $table->string("link");
            $table->string("type");
            $table->string("url");
            $table->timestamps();
            $table->foreign('article_id')
                ->references('id')
                ->on('article')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::create("article_category", function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('article_id');
            $table->integer('category_id');
            $table->boolean("is_primary")->nullable(false);
            $table->timestamps();
            $table->foreign('article_id')
                ->references('id')
                ->on('article')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('category_id')
                ->references('id')
                ->on('category')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }
}
