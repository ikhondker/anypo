<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Log;

class TestRule implements ValidationRule
{

    private $un_invoiced_amount;
    

    public function __construct($un_invoiced_amount)
    {
        $this->un_invoiced_amount = $un_invoiced_amount;
        
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        Log::debug(print_r($attribute, true));
        Log::debug(print_r($value,true));
        Log::debug($this->un_invoiced_amount);
        
        //return false;
        if ( $value > $this->un_invoiced_amount ){
            $fail('You can not create Invoice larger than the remaining un-invoiced amount i.e. '. number_format($this->un_invoiced_amount,2));
        } 
    }
}
