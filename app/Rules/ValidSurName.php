<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ImplicitRule;

class ValidSurName implements ImplicitRule
{

    private $msg = "Nazwisko jest niepoprawne!";

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
        if($value == '') {
             $this->msg = "Podaj nazwisko!";
            return false;
        }

        if (mb_strlen($value) < 3) {
            return false;
        }

        if (mb_strlen($value) > 20) {
            return false;
        }

        if (!preg_match("/^[a-zA-ZżźćńółęąśŻŹĆĄŚĘŁÓŃ]+$/", $value)) {
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
