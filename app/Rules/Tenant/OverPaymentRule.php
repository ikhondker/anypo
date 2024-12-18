<?php

namespace App\Rules\Tenant;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

use Illuminate\Support\Facades\Log;
use App\Models\Tenant\Invoice;


class OverPaymentRule implements ValidationRule
{
	private $invoice;

	public function __construct($invoice_id)
	{
		$this->invoice = Invoice::where('id', $invoice_id)->first();
	}

	/**
	 * Run the validation rule.
	 *
	 * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
	 */
	public function validate(string $attribute, mixed $value, Closure $fail): void
	{
		$un_paid_amount = $this->invoice->amount - $this->invoice->amount_paid;
		if ( $value > $un_paid_amount ){
			$fail('You can not Pay higher than the remaining un-paid amount i.e. '. number_format($un_paid_amount,2).' '. $this->invoice->currency);
		}
	}
}
