<?php

namespace App\Http\Struct\Media\Request;

use Illuminate\Foundation\Http\FormRequest;

class MediaDestroyRequest extends FormRequest
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
            'media' => 'required|array',
            'media.*.id' => 'required|integer|exists:media,id',
        ];
    }
}
