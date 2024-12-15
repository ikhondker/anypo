<?php

namespace App\Http\Requests\Tenant\Admin;

use Illuminate\Foundation\Http\FormRequest;

//use App\Rules\Tenant\GlCode;


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
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'name'				=> 'required|min:2|max:150',
			//'ac_ap_accrual'		=> 'required|min:2|max:255|alpha_dash',
			//NO 'ac_ap_accrual'		=> 'required|min:2|max:255',[new GlCode()],
			'ac_ap_accrual'		=> 'required|min:2|max:255|regex:/^[0-9A-Za-z.\-]+$/u',
			'ac_liability'		=> 'required|min:2|max:255|regex:/^[0-9A-Za-z.\-]+$/u',
			'file_to_upload'	=> 'nullable|image|mimes:jpeg,png,jpg,svg|max:1024'
		];
	}

	public function messages() {
		return [
			'ac_ap_accrual.regex'		=> 'GL Account code must only contain letters, numbers, dashes, and underscores. No space allowed.',
			'ac_liability.regex'	=> 'GL Account code must only contain letters, numbers, dashes, and underscores. No space allowed.',
		];
	}

}
