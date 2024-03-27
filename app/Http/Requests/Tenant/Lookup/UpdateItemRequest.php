<?php

namespace App\Http\Requests\Tenant\Lookup;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
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
			'code'			=> 'required|max:25|alpha_dash|unique:items,code,'. $this->item->id,
			'name'			=> 'required|min:5|max:120|unique:items,name,'. $this->item->id,
			'category_id'	=> 'required|integer|exists:categories,id',
			'uom_id'		=> 'required|integer|exists:uoms,id',
			'oem_id'		=> 'required|integer|exists:oems,id',
			'price'			=> 'required|numeric|min:0.1|max:9999999.99',
		];
	}

	public function messages() {
		return [
			'code.alpha_dash'	=> 'Item code must only contain letters, numbers, dashes, and underscores. No space allowed.',
		];
	}
}
