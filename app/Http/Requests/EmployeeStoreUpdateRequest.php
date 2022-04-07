<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreUpdateRequest extends FormRequest
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

    public function rules()
    {

        if ($this->method() == 'PUT') {
            $rules['cboempresa']   = ['exists:companies,id'];
            $rules['txtnome']      = ['required', 'min:3', 'max:60'];
            $rules['txtsobrenome'] = ['required', 'min:5', 'max:120'];
            $rules['txtemail']     = ['required','email'];
            $rules['txttelefone']  = ['required'];

        }else{

            $rules = [
                'cboempresa'   => ['exists:companies,id'],
                'txtnome'      => ['required', 'min:3', 'max:60'],
                'txtsobrenome' => ['required', 'min:5', 'max:120'],
                'txtemail'     => ['required', 'email'],
                'txttelefone'  => ['required'],
            ];
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'cboempresa'   => 'EMPRESA',
            'txtnome'      => 'NOME',
            'txtsobrenome' => 'SOBRENOME',
            'txtemail'     => 'E-MAIL',
            'txttelefone'  => 'TELEFONE',

        ];
    }
}
