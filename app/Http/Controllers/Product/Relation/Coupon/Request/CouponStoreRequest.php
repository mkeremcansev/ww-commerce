<?php

namespace App\Http\Controllers\Product\Relation\Coupon\Request;

use Illuminate\Foundation\Http\FormRequest;

class CouponStoreRequest extends FormRequest
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
            'code' => 'required|string|unique:coupons,code|max:255',
            'type' => 'required|numeric',
            'value' => 'required|numeric|max:9999999.99',
            'usage_limit' => 'nullable|numeric',
            'status' => 'required|numeric',
            'expired_at' => 'nullable|date'
        ];
    }
}
