<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PacienteFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|max:255',
            'cpf' => 'required|unique:pacientes,cpf',
            'email' => 'required|unique:pacientes|email:max:255',
            'rua' => 'required|max:255',
            'numero' => 'required|integer',
            'estado' => 'required|max:255',
            'celular' => 'required|max:20',
            'senha' => 'required|min:6',
            'cep' => 'required|min:8|max:9',
            'id_postos' => 'nullable|exists:postos,id',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $validator->errors(),
        ], 422)); 
    }

   
    
    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'cpf.required' => 'CPF obrigatório.',
            'cpf.cpf' => 'Formato de CPF inválido.',
            'cpf.unique' => 'CPF já cadastrado.',
            'email.required' => 'Email obrigatório.',
            'email.email' => 'Formato de email inválido.',
            'email.unique' => 'Email já cadastrado.',
            'rua.required' => 'Rua obrigatória.',
            'numero.required' => 'Número obrigatório.',
            'estado.required' => 'Estado obrigatório.',
            'celular.required' => 'Celular obrigatório.',
            'senha.required' => 'Senha obrigatória.',
            'id_postos.exists' => 'O posto informado não existe.',
            'cep.max' => 'O campo cep deve conter no máximo 9 caracteres.',
            'cep.min' => 'O campo cep deve conter no mínimo 8 caracteres.',
        ];
    }
}
