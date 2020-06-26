<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ImplicitRule;

class ValidOfferTitle implements ImplicitRule
{

    private $msg = "Tytuł jest niepoprawny!";

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
        if(!is_string($value))
            return false;

        if(strlen($value) < 5) {
            $this->msg = "Tytuł jest za krótki! (min. 5)";
            return false;
        }

        if(strlen($value) > 80) {
            $this->msg = "Tytuł jest za długi! (max. 80)";
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->msg;
    }
}
