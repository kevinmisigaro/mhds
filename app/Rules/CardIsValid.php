<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\InsuranceCard;

class CardIsValid implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return InsuranceCard::where(['id' => $value, 'valid' => true])->exists();     
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This :attribute is not validated';
    }
}
