<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanieStoreUpdateRequest extends FormRequest
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

            $rules['filelogotipo'] = ['required', 'image:jpg, jpeg, png','dimensions:min_width=100,min_height=200'];
            $rules['txtnome']      = ['required', 'min:3', 'max:60'];
            $rules['txtendereco']  = ['required', 'min:10', 'max:120'];
            $rules['txtsite']      = ['required'];
            $rules['txtemail']     = ['required','email'];


        }else{

            $rules = [
                'filelogotipo' => ['required', 'image:jpg, jpeg, png','dimensions:min_width=100,min_height=200'],
                'txtnome'      => ['required', 'min:3', 'max:60'],
                'txtendereco'  => ['required', 'min:10', 'max:120'],
                'txtsite'      => ['required'],
                'txtemail'     => ['required', 'email'],
            ];
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'filelogotipo' => 'LOGOTIPO',
            'txtnome'      => 'NOME',
            'txtendereco'  => 'ENDEREÇO',
            'txtsite'      => 'SITE',
            'txtemail'     => 'E-MAIL',

        ];
    }
}
