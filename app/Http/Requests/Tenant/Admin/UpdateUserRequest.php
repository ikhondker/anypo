<?php

namespace App\Http\Requests\Tenant\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
			'name'			=> 'required|min:5|max:100',
			'email'			=> 'required|max:100|unique:users,email,'. $this->user->id,
			'cell'			=> 'required|max:20|unique:users,cell,'. $this->user->id,
			//'role'		=> 'required',
			'facebook'		=> 'nullable|url' ,
			'linkedin'		=> 'nullable|url',
			'file_to_upload'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024'
		];
	}
}
