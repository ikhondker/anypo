<?php

namespace App\Http\Requests\Landlord;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
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
        //TODO check if mail and cell will be unique
        return [
            'name'              => 'required|max:100',
            'address1'          => 'required|max:100',
            'email'             => 'required|email|max:100',
            'cell'              => 'required|max:20',
            'file_to_upload'    => 'image|mimes:jpeg,png,jpg,gif|max:1024'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
    */
    public function messages(): array
    {
        return [
            //'site.required' => 'A site site  is required',
        ];
    }

}
