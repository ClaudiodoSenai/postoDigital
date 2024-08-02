<?php

namespace App\Http\Controllers;

use App\Models\Posto;
use Illuminate\Http\Request;
use App\Services\GeocodingService;


class PostoController extends Controller
{
    public function criarPosto(Request $request)
    {
        $geocodingService = new GeocodingService();
        $coordinates = $geocodingService->getCoordinates($request->endereco);
    
        if (!$coordinates) {
            return response()->json([
                'success' => false,
                'message' => 'Não foi possível obter as coordenadas do endereço fornecido.',
            ], 400);
        }
    
        $posto = Posto::create([
            'nome' => $request->nome, 
            'localizacao' => $request->localizacao,
            'horarioFuncionamento' => $request->horarioFuncionamento,
            'diaFuncionamento' => $request->diaFuncionamento,
            'servicos' => $request->servicos,
            'latitude' => $coordinates['lat'],
            'longitude' => $coordinates['lng'],
        ]);
    
        return response()->json([
            "success" => true,
            "message" => "Posto cadastrado com sucesso",
            "data" => $posto
        ], 200);
    }
  
    public function retornarTodos()
    {
        $postos = Posto::all();
        return response()->json([
            'status' => true,
            'data' => $postos
        ]);
    }

  
    public function atualizarPosto(Request $request)
    {
        $posto = Posto::find($request->id);

        if (!isset($posto)) {
            return response()->json([
                'status' => false,
                'message' => 'Posto não encontrado',
            ]);
        }

        $posto->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Posto atualizado com sucesso',
            'data' => $posto
        ]);
    }

  
    public function excluirPosto(Request $request)
    {
        $posto = Posto::find($request->id);

        if (!isset($posto)) {
            return response()->json([
                'status' => false,
                'message' => 'Posto não encontrado',
            ]);
        }

        $posto->delete();

        return response()->json([
            'status' => true,
            'message' => 'Posto excluído com sucesso'
        ]);
    }
}
