<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NegativeValueRule implements Rule
{
       /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return is_numeric($value) && $value > 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O valor tem que ser numérico e maior que zero';
    }
}
