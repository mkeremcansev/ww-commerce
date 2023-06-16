<?php

namespace App\Http\Struct\User\Relation\Role\Request;

use Illuminate\Foundation\Http\FormRequest;

class RoleStoreRequest extends FormRequest
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
            'name' => 'required|max:255|unique:roles,name',
            'permission_id' => 'required|array',
            'permission_id.*' => 'required|integer|exists:permissions,id',
        ];
    }
}
