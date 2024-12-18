<?php

namespace App\Rules\Tenant;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

use Illuminate\Support\Facades\Log;
use App\Models\Tenant\Po;

class OverInvoiceRule implements ValidationRule
{
	private $po;

	public function __construct($po_id)
	{
		$this->po = Po::where('id', $po_id)->first();
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
		$un_invoiced_amount = $this->po->amount - $this->po->amount_invoice;
		if ( $value > $un_invoiced_amount ){
			$fail('You can not create Invoice higher than the remaining un-invoiced amount i.e. '. number_format($un_invoiced_amount,2).' '. $this->po->currency);
		}

	}
}
