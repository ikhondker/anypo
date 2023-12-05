<?php

namespace App\Http\Requests\Tenant\Lookup;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
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
            'name'          => 'required|min:5|max:120',
            'category_id'   => 'required|integer|exists:categories,id',
            'uom_id'        => 'required|integer|exists:uoms,id',
            'oem_id'        => 'required|integer|exists:oems,id',
            'code'          => 'required|max:10|unique:items,code,'. $this->item->id,
            'price'         => 'required|numeric|min:1.00|max:999999.99',
        ];
    }
}
