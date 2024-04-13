<?php

namespace App\Rules\Tenant;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class GlCode implements ValidationRule
{
	/**
	 * Run the validation rule.
	 *
	 * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
	 */
	public function validate(string $attribute, mixed $value, Closure $fail): void
	{

		$result = preg_match('/^[0-9A-Za-z.\-]+$/u', $value);

		if ( $result < 0 ){
			$fail('Account code must only contain letters, numbers, dashes, and underscores. No space allowed 1.');
		} 

		// if (! is_string($value) && ! is_numeric($value)) {
        //     return false;
        // }

	}
}
