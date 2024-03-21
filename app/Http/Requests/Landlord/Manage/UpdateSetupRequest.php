<?php

namespace App\Http\Requests\Landlord\Manage;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSetupRequest extends FormRequest
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
			'file_to_upload'	=> 'nullable|image|mimes:jpeg,png,jpg,svg|max:1024'
		];
	}
}
