<?php

declare(strict_types=1);

namespace App\Http\Controllers\Article\Catalog;

use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            "search" => "string",
            "page" => "required|integer",
            "perPage" => "required|integer",
            "category" => "integer|exists:category,id",
        ];
    }
}
