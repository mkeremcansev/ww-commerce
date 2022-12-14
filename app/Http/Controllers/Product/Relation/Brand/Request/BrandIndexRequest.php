<?php

namespace App\Http\Controllers\Product\Relation\Brand\Request;

use Illuminate\Foundation\Http\FormRequest;

class BrandIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'id' => 'nullable',
            'title' => 'nullable',
            'slug' => 'nullable',
            'path' => 'nullable'
        ];
    }
}
