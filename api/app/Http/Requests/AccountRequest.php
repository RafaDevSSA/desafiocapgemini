<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            "holder"=>"required",
            "number"=>"required",
            "agency"=>"required",
            "password"=>"required",

        ];
    }

    public function messages()
    {
        return [
            'holder.required' => 'Informe o titular da conta!',
            'number.required' => 'Informe o número da conta!',
            'agency.required' => 'Informe a agencia da conta!',
            'password.required' => 'Informe a senha da conta!',
        ];
    }
}
