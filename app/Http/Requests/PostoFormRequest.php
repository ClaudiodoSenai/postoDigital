<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostoFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|max:255',
            'localizacao' => 'required|max:255',
            'horarioFuncionamento' => 'required|max:255',
            'diaFuncionamento' => 'required|max:255',
            'servicos' => 'required',
        ];
    }

 
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $validator->errors()
        ], 422));
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.max' => 'O campo nome deve conter no máximo 255 caracteres.',
            'localizacao.required' => 'O campo localização é obrigatório.',
            'localizacao.max' => 'O campo localização deve conter no máximo 255 caracteres.',
            'horarioFuncionamento.required' => 'O campo horário de funcionamento é obrigatório.',
            'horarioFuncionamento.max' => 'O campo horário de funcionamento deve conter no máximo 255 caracteres.',
            'diaFuncionamento.required' => 'O campo dias de funcionamento é obrigatório.',
            'diaFuncionamento.max' => 'O campo dias de funcionamento deve conter no máximo 255 caracteres.',
            'servicos.required' => 'O campo serviços oferecidos é obrigatório.',
        ];
    }
}
