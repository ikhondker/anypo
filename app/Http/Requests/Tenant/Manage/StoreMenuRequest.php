<?php

namespace App\Http\Requests\Tenant\Manage;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
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
			'raw_route_name'	=> 'required|min:2|max:100|unique:menus,raw_route_name',
		];
	}
}
