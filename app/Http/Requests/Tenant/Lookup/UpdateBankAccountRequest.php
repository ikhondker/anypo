<?php

namespace App\Http\Requests\Tenant\Lookup;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBankAccountRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			'ac_name'	=> 'required|min:2|max:100|unique:bank_accounts,ac_name,'. $this->bank_account->id,
			'ac_number'	=> 'required|min:2|max:100|unique:bank_accounts,ac_number,'. $this->bank_account->id,
			'ac_bank'	=> 'required|min:2|max:255|regex:/^[0-9A-Za-z.\-]+$/u',
		];
	}
	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array
	 */
	public function messages() {
		return [
			'ac_bank.regex'	=> 'Bank GL Account code must only contain letters, numbers, dashes, and underscores. No space allowed.',
		];
	}
}
