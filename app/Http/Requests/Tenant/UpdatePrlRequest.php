<?php

namespace App\Http\Requests\Tenant;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePrlRequest extends FormRequest
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
			'item_description'	=> 'required|min:2|max:150',
			'qty'				=> 'required|numeric|min:1.00|max:9999999.99',
			'price'				=> 'required|numeric|min:1.00|max:9999999.99',
		];
	}
}
