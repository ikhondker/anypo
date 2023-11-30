<?php
namespace App\Http\Requests\Landlord\Admin;
//namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Log;


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
            'raw_route_name'  => 'required|max:100',
            'route_name'      => 'required|max:100',
            'access'          => 'required|in:F,C,B,S,X'
        ];
    }
}
