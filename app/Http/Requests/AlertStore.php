<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;   

class AlertStore extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge(['id' => '1']);
    }

    public function rules()
    {
        return [
            'search_id' => 'required',
            'activate' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'search_id.required' => 'Search_id is a required field.',
            'activate.required' => 'Activate is a required field.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));   
    }   
}
