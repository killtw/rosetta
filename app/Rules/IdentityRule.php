<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Str;

class IdentityRule implements Rule
{
    const ALPHABET_MAP = 'BAKJHGFEDCNMLVUTSRQPZWYX0000OI';

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $value = Str::upper($value);
        $preg = '/^[A-Z][1289ABCD]\d{8}$/';

        if (! preg_match($preg, $value)) {
            return false;
        }

        $result = strpos(self::ALPHABET_MAP, $value[0]) % 10;
        if (! is_numeric($value[1])) {
            $value[1] = ord($value[1]) - 65;
        }
        for ($i = 1; $i < 9; $i++) {
            $result += $value[$i] * (9 - $i);
        }
        $result += $value[9];

        return $result % 10 === 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute 不是合法的身分證字號';
    }
}
