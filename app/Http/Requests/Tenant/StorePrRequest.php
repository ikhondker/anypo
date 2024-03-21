<?php

namespace App\Http\Requests\Tenant;

use Illuminate\Foundation\Http\FormRequest;

class StorePrRequest extends FormRequest
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
			'summary'			=> 'required|min:2|max:255',
			//'file_to_upload'	=> 'nullable|file|mimes:zip,rar,doc,docx,xls|max:512'
			//'file_to_upload'	=> 'required|file|mimes:zip,rar,doc,docx,xls,xlsx,pdf,jpg|max:512'
		];
	}
}
