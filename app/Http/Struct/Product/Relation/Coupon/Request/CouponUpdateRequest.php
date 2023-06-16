<?php

namespace App\Http\Struct\Product\Relation\Coupon\Request;

use Illuminate\Foundation\Http\FormRequest;

class CouponUpdateRequest extends FormRequest
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
            'code' => 'required|string|max:255|unique:coupons,code,'.$this->id.',id',
            'type' => 'required|numeric',
            'value' => 'required|numeric|max:9999999.99',
            'usage_limit' => 'nullable|numeric',
            'status' => 'required|numeric',
            'expired_at' => 'nullable|date',
        ];
    }
}
