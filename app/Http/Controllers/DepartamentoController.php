<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function criarDepartamento(Request $request)
    {
        $departamento = Departamento::create([
            'nome' => $request->nome]
        );

        return response()->json([
            "success" => true,
            "message" => "Departamento cadastrado com sucesso",
            "data" => $departamento
        ], 200);
    }

    public function listarDepartamentos()
    {
        $departamentos = Departamento::all();

        return response()->json([
            'status' => true,
            'data' => $departamentos
        ]);
    }

    public function buscarPorId($id)
    {
        $departamento = Departamento::find($id);

        if (!$departamento) {
            return response()->json([
                'status' => false,
                'message' => "Departamento não encontrado"
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $departamento
        ]);
    }

    public function atualizarDepartamento(Request $request, $id)
    {
        $departamento = Departamento::find($id);

        if (!$departamento) {
            return response()->json([
                'status' => false,
                'message' => 'Departamento não encontrado',
            ], 404);
        }

        $departamento->update(['nome' => $request->nome]);

        return response()->json([
            'status' => true,
            'message' => 'Departamento atualizado com sucesso',
            'data' => $departamento
        ]);
    }
}

