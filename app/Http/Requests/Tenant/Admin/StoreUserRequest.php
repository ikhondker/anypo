<?php

namespace App\Http\Requests\Tenant\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
			'name'      => 'required|max:100',
			'email'     => 'required|email|max:100|unique:users,email',
			'cell'      => 'required|max:20|unique:users,cell',
			'role'      => 'required',
			//'password'  => 'required|confirmed|min:6',
			//'fbpage'    => 'nullable|url' ,
			//'lnpage'    => 'nullable|url',
		];
	}

	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array
	 */
	public function messages() {
		return [
			'name.required'		=> 'User Name is Required',
			'email.required'	=> 'email is Required',
			'email.unique'		=> 'This email is in use. It should be unique.',
			'cell.required'		=> 'Cell Number is Required',
			'cell.unique'		=> 'This cell number is in use. It should be unique.',
		];
	}

}
