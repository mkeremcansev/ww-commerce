<?php

namespace App\Http\Struct\User\Rule;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Translation\PotentiallyTranslatedString;

class UserOldPasswordCheck implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! Hash::check($value, auth()->user()->password)) {
            $fail(__('words.theOldPasswordIsIncorrect'));
        }
    }
}
