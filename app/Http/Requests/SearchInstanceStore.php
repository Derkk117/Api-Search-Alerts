<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;   

class SearchInstanceStore extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
    }

    public function rules()
    {
        return [
            'alert_id' => 'required',
            'page_name' => 'required',
            'activate' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'alert_id.required' => 'Alert_id is a required field.',
            'page_name.required' => 'Concept is a required field.',
            'activate.required' => 'Concept is a required field.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));   
    }   
}
