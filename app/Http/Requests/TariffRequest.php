<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TariffRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'min_cost' => 'required',
            'cost_per_minute' => 'required',
            'cost_per_km' => 'required',
            'free_km_count' => 'required',
            'free_minutes_count' => 'required',
        ];
    }


    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Validation error message.',
            'min_cost.required' => 'Validation error message.',
            'cost_per_minute.required' => 'Validation error message.',
            'cost_per_km.required' => 'Validation error message.',
            'free_km_count.required' => 'Validation error message.',
            'free_minutes_count.required' => 'Validation error message.',
        ];
    }
}
