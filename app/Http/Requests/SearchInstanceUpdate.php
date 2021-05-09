<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;   

class SearchInstanceUpdate extends FormRequest
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
        $id = $this->route('searchInstance')->id;
        return [
            'activate' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'activate.required' => 'Concept is a required field.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));   
    }   
}
