<?php

namespace App\Http\Struct\Product\Relation\Brand\Request;

use Illuminate\Foundation\Http\FormRequest;

class BrandUpdateRequest extends FormRequest
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
            'title' => 'required|max:255|unique:brands,title,'.$this->id.',id',
            'media' => 'required|array',
            'media.id' => 'required|integer|exists:media,id',
        ];
    }
}
