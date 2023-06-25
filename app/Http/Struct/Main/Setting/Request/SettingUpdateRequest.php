<?php

namespace App\Http\Struct\Main\Setting\Request;

use Illuminate\Foundation\Http\FormRequest;

class SettingUpdateRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'keywords' => 'required|string|max:1000',
            'default_image_mime_type' => 'required|string|max:10',
            'logo' => 'required|array',
            'logo.id' => 'required|numeric',
            'logo.mime_type' => 'required|string|max:10',
            'logo.extension' => 'required|string',
            'logo.full_path' => 'required|string',
            'logo.size' => 'required|numeric',
            'favicon' => 'required|array',
            'favicon.id' => 'required|numeric',
            'favicon.mime_type' => 'required|string|max:10',
            'favicon.extension' => 'required|string',
            'favicon.full_path' => 'required|string',
            'favicon.size' => 'required|numeric',
        ];
    }
}
