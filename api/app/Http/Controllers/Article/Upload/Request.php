<?php

declare(strict_types=1);

namespace App\Http\Controllers\Article\Upload;

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
            "file" =>
                "required|file|mimetypes:text/html,application/json|max:30072",
        ];
    }
}
