<?php

namespace App\Rules;

use App\Models\UsersType;
use App\Models\Wallet;
use Illuminate\Contracts\Validation\Rule;

class PayerValidationRule implements Rule
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
        return Wallet::find($value)->user->users_type_id == UsersType::ID_TYPE_COMUM;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Não é possível transferir de uma conta lojista';
    }

}
