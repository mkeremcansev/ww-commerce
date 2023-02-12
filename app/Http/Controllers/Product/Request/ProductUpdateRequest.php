<?php

namespace App\Http\Controllers\Product\Request;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'title' => 'required|max:255',
            'content' => 'required',
            'price' => 'required|numeric|max:9999999.99',
            'stock' => 'nullable|numeric',
            'status' => 'required|boolean',
            'brand_id' => 'required|integer|exists:brands,id',
            'category_id' => 'required|array',
            'category_id.*' => 'required|integer|exists:categories,id',
            'variants' => 'nullable|array',
            'variants.*.attributes' => 'nullable|array',
            'variants.*.stock' => 'nullable|numeric|max:9999999.99',
            'variants.*.price' => 'nullable|numeric',
            'variants.*.attributes.*.attribute_id' => 'required|integer|exists:attributes,id',
            'variants.*.attributes.*.attribute_value_id' => 'required|integer|exists:attribute_values,id',
        ];
    }
}
