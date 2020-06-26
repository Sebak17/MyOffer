<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ImplicitRule;

class ValidOfferPrice implements ImplicitRule
{

    private $msg = "Cena jest niepoprawna!";

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
        if(!is_numeric($value))
            return false;

        $number = floatval($value);

        if($number < 0) {
            $this->msg = "Cena nie może być mniejsza niż 0!";
            return false;
        }

        if($number > 10000000) {
            $this->msg = "Cena nie może być większa niż 10 000 000!";
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
