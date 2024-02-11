<?php

namespace App\Http\Requests\Tenant\Manage;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStatusRequest extends FormRequest
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
			'code'	=> 'required|min:2|max:100|unique:statuses,code,'. $this->status->code,
			'name'	=> 'required|min:2|max:100',
			'badge'	=> 'required|min:2|max:100',
		];
	}
}
