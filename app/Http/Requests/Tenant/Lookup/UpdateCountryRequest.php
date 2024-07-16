<?php

namespace App\Http\Requests\Tenant\Lookup;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCountryRequest extends FormRequest
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
			//TODO 'country'	=> 'required|min:2|max:2|unique:countries,country,'. $this->country->country,
			//TODO 'name'		=> 'required|min:2|max:100|unique:countries,name,'. $this->country->name,
            'name'		=> 'required|min:2|max:100',

		];
	}
}
