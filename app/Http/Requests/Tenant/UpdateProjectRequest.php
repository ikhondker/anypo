<?php

namespace App\Http\Requests\Tenant;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
			'code'		=> 'required|max:25|alpha_dash|unique:projects,code,'. $this->project->id,
			'name'		=> 'required|min:2|max:100|unique:projects,name,'. $this->project->id,
		];
	}

	public function messages() {
		return [
			'code.alpha_dash'	=> 'Project code must only contain letters, numbers, dashes, and underscores. No space allowed.',
		];
	}

}
