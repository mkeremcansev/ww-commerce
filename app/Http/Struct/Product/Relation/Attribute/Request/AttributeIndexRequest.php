<?php

namespace App\Http\Struct\Product\Relation\Attribute\Request;

use Illuminate\Foundation\Http\FormRequest;

class AttributeIndexRequest extends FormRequest
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
            'trashed' => 'nullable|boolean',
        ];
    }
}
