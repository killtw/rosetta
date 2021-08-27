<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneRule implements Rule
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
        $preg = '/(\(??(\+886)\)??|0)9(\s*?|\-??)(\d{2}(\s*?|\-??)\d{3}(\s*?|\-??)\d{3})/';

        return ! ! preg_match($preg, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return ':attribute 不是合法的手機號碼';
    }
}
