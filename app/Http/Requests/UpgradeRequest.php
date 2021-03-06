<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpgradeRequest extends FormRequest
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
            //
            'name' => 'required',
            // 'farmType' => 'required',

            'farmType' => 'required_if:name, ==, farm_manager'
           
        ];
       
    }
    public function messages()
    {
        return [
            'name.required' => 'Please Choose at least one of the above options',

        ];
    }
}
