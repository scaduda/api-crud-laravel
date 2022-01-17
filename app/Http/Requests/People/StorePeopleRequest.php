<?php

namespace App\Http\Requests\People;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class StorePeopleRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|max:14',
            'email' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15'
        ];
    }

    public function bodyParams()
    {
        return [
            'name' => [
                'description' => 'Name',
                'example' => 'Raphael Goettenauer'
            ],
            'cpf' => [
                'description' => 'CPF',
                'example' => '000.000.000-00'
            ],
            'people_id' => [
                'description' => 'Id of people',
                'example' => 'a9cd6d61-0d3a-49e1-b660-92ae62308eff'
            ],
            'email' => [
                'description' => 'Email',
                'example' => 'example@example.com'
            ],
            'phone_number' => [
                'description' => 'Phone number',
                'example' => '(79) 99999-9999'
            ]
        ];
    }

    /**
     * Retorna os erros encontrados
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY));
    }


}
