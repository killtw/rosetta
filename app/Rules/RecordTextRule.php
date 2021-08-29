<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RecordTextRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $preg = '/\d{15}/';

        return ! ! preg_match($preg, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute 沒有包含場所代碼';
    }
}
