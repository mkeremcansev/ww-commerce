<?php

namespace App\Http\Struct\Product\Relation\Category\Request;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
            'title' => 'required|max:255|unique:categories,title,'.$this->id.',id',
            'category_id' => 'nullable|exists:categories,id',
            'attribute_ids' => 'required|array',
            'attribute_ids.*' => 'required|numeric|exists:attributes,id',
            'media' => 'required|array',
            'media.id' => 'required|integer|exists:media,id',
        ];
    }
}
