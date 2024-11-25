<?php

namespace App\Http\Requests\Landlord;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
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
	 * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
	 */
	public function rules(): array
	{
		return [
			'name'				=> 'required|max:100',
			'address1'			=> 'required|max:100',
			'cell'				=> 'required|min:6|max:20|unique:accounts,cell,'. $this->account->id,
			'email'				=> 'required|unique:accounts,email,'. $this->account->id,
			'file_to_upload'	=> 'image|mimes:jpeg,png,jpg,gif|max:1024'
		];
	}

	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array<string, string>
	*/
	public function messages(): array
	{
		return [
			//'site.required' => 'A site site is required',
		];
	}

}
