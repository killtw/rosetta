<?php

namespace App\Rules;

use App\Models\Merchant;
use Illuminate\Contracts\Validation\Rule;

class RecordMerchantNumberRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $preg = '/\d{15}/';

        if (preg_match($preg, $value, $matches, PREG_UNMATCHED_AS_NULL)) {
            $id = ltrim($matches[0], 0);

            return Merchant::where('id', $id)->exists();
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute 包含的場所代碼不存在';
    }
}
