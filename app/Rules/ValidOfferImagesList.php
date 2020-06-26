<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ImplicitRule;

class ValidOfferImagesList implements ImplicitRule
{

    private $msg = "Zdjęcia są niepoprawne!";

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
        if(!is_array($value) || count($value) == 0) {
            $this->msg = "Dodaj chociaż jedno zdjęcie!";
            return false;
        }

        foreach ($value as $v) {
            if(!is_string($v))
                return false;

            if(strlen($v) < 40)
                return false;

            if(strlen($v) > 50)
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
