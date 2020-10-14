<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RealtorRequest extends FormRequest
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
            'name' => 'required|string|min:5',
            'email' => 'required|email',
            'dateOfBirth' => 'required|date',
            'phone' => 'required',
            'gender' => 'required|string',
            'address' => 'required|string',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'password' => 'required|confirmed|min:6'

        ];
    }
}
