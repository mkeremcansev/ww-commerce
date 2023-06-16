<?php

namespace App\Http\Struct\Product\Relation\Attribute\Relation\AttributeValue\Request;

use Illuminate\Foundation\Http\FormRequest;

class AttributeValueUpdateRequest extends FormRequest
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
            'title' => 'required|max:255|unique:attribute_values,title,'.$this->id.',id',
            'code' => 'required|max:255|unique:attribute_values,code,'.$this->id.',id',
            'media' => 'required|array',
            'media.id' => 'required|integer|exists:media,id',
            'attribute_id' => 'required|exists:attributes,id',
        ];
    }
}
