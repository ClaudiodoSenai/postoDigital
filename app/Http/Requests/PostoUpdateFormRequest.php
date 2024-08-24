<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostoUpdateFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|max:255',
            'estado' => 'required|min:2|max:2',
            'rua' => 'required|max:120',
            'numero' => 'required|max:10',
            'horarioFuncionamento' => 'required|max:255',
            'diaFuncionamento' => 'required|max:255',
            'servicos' => 'required',
            'cep' => 'required|min:8|max:9',
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
            'cep.required' => "O campo cep é obrigatório.",
            'cep.max' => 'O campo cep deve conter no máximo 9 caracteres.',
            'cep.min' => 'O campo cep deve conter no mínimo 8 caracteres.',
            'estado.required' => 'Estado obrigatório.',
            'estado.min' => 'O campo estado deve conter no mínimo 2 caracteres.',
            'estado.max' => 'O campo estado deve conter no máximo 2 caracteres.',
            'rua.required' => 'RUA obrigatório.',
            'rua.max' => 'O campo rua deve conter no máximo 120 caracteres.',
            'numero.required' => 'Número obrigatório.',
            'numero.max' => 'O campo número deve conter no máximo 10 caracteres.',
            'horarioFuncionamento.required' => 'O campo horário de funcionamento é obrigatório.',
            'horarioFuncionamento.max' => 'O campo horário de funcionamento deve conter no máximo 255 caracteres.',
            'diaFuncionamento.required' => 'O campo dias de funcionamento é obrigatório.',
            'diaFuncionamento.max' => 'O campo dias de funcionamento deve conter no máximo 255 caracteres.',
            'servicos.required' => 'O campo serviços oferecidos é obrigatório.',
          
        ];
    }
}
