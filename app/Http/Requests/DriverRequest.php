<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'driver_license_number' => 'required',
            'driver_license_series' => 'required',
            'driver_license_expire_date' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Validation error message.',
            'email.required' => 'Validation error message.',
            'driver_license_number.required' => 'Validation error message.',
            'driver_license_series.required' => 'Validation error message.',
            'driver_license_expire_date.required' => 'Validation error message.',
        ];
    }
}
