<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'from_address' => 'required',
            'to_address' => 'required',
            'from_coordinate_x' => 'required',
            'from_coordinate_y' => 'required',
            'to_coordinate_x' => 'required',
            'to_coordinate_y' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'from_address.required' => 'Validation error message.',
            'to_address.required' => 'Validation error message.',
            'from_coordinate_x.required' => 'Validation error message.',
            'from_coordinate_y.required' => 'Validation error message.',
            'to_coordinate_x.required' => 'Validation error message.',
            'to_coordinate_y.required' => 'Validation error message.',
        ];
    }
}
