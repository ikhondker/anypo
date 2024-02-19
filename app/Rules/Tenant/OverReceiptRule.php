<?php

namespace App\Rules\Tenant;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

use Illuminate\Support\Facades\Log;
use App\Models\Tenant\Pol;



class OverReceiptRule implements ValidationRule
{
    private $pol;

	public function __construct($pol_id)
	{
	   $this->pol = Pol::where('id', $pol_id)->first();
	}


    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        	//Log::debug(print_r($attribute, true));
		//Log::debug(print_r($value,true));
		//Log::debug($this->un_invoiced_amount);
		$un_received_qty = $this->pol->qty - $this->pol->received_qty;
		if ( $value > $un_received_qty ){
			$fail('You can not receive higher than the due quantities i.e. '. number_format($un_received_qty,2));
		} 

    }
}
