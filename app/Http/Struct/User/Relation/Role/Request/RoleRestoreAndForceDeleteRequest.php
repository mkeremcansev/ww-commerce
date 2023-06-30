<?php

namespace App\Http\Struct\User\Relation\Role\Request;

use Illuminate\Foundation\Http\FormRequest;

class RoleRestoreAndForceDeleteRequest extends FormRequest
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
            'ids' => 'required|array',
            'ids.*' => 'required|integer|exists:roles,id',
        ];
    }
}
