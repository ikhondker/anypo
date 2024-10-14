<?php

namespace App\Http\Requests\Tenant;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceLineRequest extends FormRequest
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
			'summary'	=> 'required|min:2|max:200',
			'qty'				=> 'required|numeric|min:1.00|max:999999.99',
			'price'				=> 'required|numeric|min:1.00|max:999999.99',
			'tax'				=> 'required|numeric|min:0.00|max:999999.99',
			'gst'				=> 'required|numeric|min:0.00|max:999999.99',
		];
	}
}
