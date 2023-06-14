<?php

namespace App\Http\Controllers\User\Relation\Role\Request;

use Illuminate\Foundation\Http\FormRequest;

class RoleUpdateRequest extends FormRequest
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
            'name' => 'required|max:255|unique:roles,name,'.$this->id.',id',
            'permission_id' => 'required|array',
            'permission_id.*' => 'required|integer|exists:permissions,id',
        ];
    }
}
