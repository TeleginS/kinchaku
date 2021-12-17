<?php

use App\Http\Controllers\Article\Upload\Action as ArticleUploadAction;
use App\Http\Controllers\Category\Catalog\Action as CategoryCatalogAction;
use App\Http\Controllers\Article\Catalog\Action as ArticleCatalogAction;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(
    ['prefix' => '/articles'],
    static function (): void {
        Route::get('/', ArticleCatalogAction::class);
        Route::post('/upload', ArticleUploadAction::class);
    }
);

Route::group(
    ['prefix' => '/categories'],
    static function (): void {
        Route::get('/', CategoryCatalogAction::class);
    }
);
