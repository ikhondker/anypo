<?php

namespace App\Http\Requests\Tenant\Lookup;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
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
			//'code'			=> 'required|max:25|alpha_dash|unique:items,code',
			'code'			=> 'required|max:25|regex:/^[0-9A-Za-z.\-]+$/u|unique:items,code',
			'name'			=> 'required|min:5|max:120|unique:items,name',
			'category_id'	=> 'required|integer|exists:categories,id',
			'uom_id'		=> 'required|integer|exists:uoms,id',
			'oem_id'		=> 'required|integer|exists:oems,id',
			'price'			=> 'required|numeric|min:0.10|max:9999999.99',
			'ac_expense'	=> 'required|min:2|max:255|alpha_dash',
		];
	}

	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array
	 */
	public function messages() {
		return [
			'code.regex'	=> 'Item code must only contain letters, numbers, dashes, and underscores. No space allowed.',
		];
	}

}
