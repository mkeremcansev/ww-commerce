<?php

namespace App\Http\Controllers\Product\Relation\Attribute\Relation\AttributeValue\Request;

use Illuminate\Foundation\Http\FormRequest;

class AttributeValueUpdateRequest extends FormRequest
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
            'code' => 'required|max:255',
            'path' => 'required|max:255',
            'attribute_id' => 'required|exists:attributes,id'
        ];
    }
}
