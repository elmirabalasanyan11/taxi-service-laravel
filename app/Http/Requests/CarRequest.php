<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
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
            'brand' => 'required',
            'model' => 'required',
            'color' => 'required',
            'government_number' => 'required',
            'issue_date' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Validation error message.',
            'brand.required' => 'Validation error message.',
            'model.required' => 'Validation error message.',
            'color.required' => 'Validation error message.',
            'government_number.required' => 'Validation error message.',
            'issue_date.required' => 'Validation error message.'
        ];
    }
}
