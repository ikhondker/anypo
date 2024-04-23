<?php

namespace App\Http\Requests\Tenant;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeptBudgetRequest extends FormRequest
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
			//unique:users,mobile,NULL,id,isd,' . $request->isd,
			'budget_id'		=> 'required|integer|exists:budgets,id|unique:dept_budgets,budget_id,'.$this->budget_id.',id,dept_id,'. $this->dept_id,
			'dept_id'		=> 'required|integer|exists:depts,id|unique:dept_budgets,budget_id,'.$this->budget_id.',id,dept_id,'. $this->dept_id,
			//'budget_id'		=> 'required|integer|exists:budgets,id|unique:dept_budgets,budget_id,dept_id',
			//'dept_id'		=> 'required|unique:dept_budgets,budget_id,dept_id',
			'amount'		=> 'required|numeric|min:1.00|max:9999999999.99',
		];
	}

	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array
	 */
	public function messages() {
		return [
			'budget_id.unique'=> 'Budget for this Department already exists. Please update budget if needed.',
			'dept_id.unique'=> 'Budget for this Department already exists. Please update budget if needed.',
		];
	}
}
