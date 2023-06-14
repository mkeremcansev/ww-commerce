<?php

namespace App\Http\Controllers\Product\Relation\Category\Request;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
            'title' => 'required|max:255|unique:categories,title',
            'category_id' => 'nullable|exists:categories,id',
            'media' => 'required|array',
            'media.id' => 'required|integer|exists:media,id',
        ];
    }
}
