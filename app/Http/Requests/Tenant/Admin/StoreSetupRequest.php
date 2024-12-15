<?php

namespace App\Http\Requests\Tenant\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreSetupRequest extends FormRequest
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
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'ac_ap_accrual'		=> 'required|min:2|max:255|regex:/^[0-9A-Za-z.\-]+$/u',
			'ac_liability'		=> 'required|min:2|max:255|regex:/^[0-9A-Za-z.\-]+$/u',
		];
	}
	public function messages() {
		return [
			'ac_ap_accrual.regex'	=> 'Gl Account code must only contain letters, numbers, dashes, and underscores. No space allowed.',
			'ac_liability.regex'	=> 'GL Account code must only contain letters, numbers, dashes, and underscores. No space allowed.',
		];
	}
}
