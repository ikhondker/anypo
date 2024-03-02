<?php

namespace App\Http\Requests\Tenant\Workflow;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHierarchyRequest extends FormRequest
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
			'name'				=> 'required|min:2|max:100|unique:hierarchies,name,'. $this->hierarchy->id,
			'approver_id_1'		=> 'required|integer|exists:users,id',
			//'approver_id_2'		=> 'integer|exists:users,id',
			//'approver_id_3'		=> 'integer|exists:users,id',
			//'approver_id_4'		=> 'integer|exists:users,id',
			//'approver_id_5'		=> 'integer|exists:users,id',
		];
	}
}
