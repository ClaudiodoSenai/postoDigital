<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostoUpdateFormRequest;
use App\Models\Posto;
use Illuminate\Http\Request;
use App\Services\GeocodingService;


class PostoController extends Controller
{
    public function criarPosto(Request $request)
{
    $enderecoCompleto = "{$request->cep}, {$request->estado}, {$request->rua}, {$request->numero}";
    $geocodingService = new GeocodingService();
    $coordinates = $geocodingService->getCoordinates($enderecoCompleto);
    
    if (!$coordinates) {
        return response()->json([
            'success' => false,
            'message' => 'Não foi possível obter as coordenadas do endereço fornecido.',
        ], 400);
    }
    
    $posto = Posto::create([
        'nome' => $request->nome, 
        'horarioFuncionamento' => $request->horarioFuncionamento,
        'diaFuncionamento' => $request->diaFuncionamento,
        'servicos' => $request->servicos,
        'cep' => $request->cep,
        'estado' => $request->estado,
        'rua' => $request->rua,
        'numero' => $request->numero,
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

   

    public function atualizarPosto(PostoUpdateFormRequest $request)
    {
        $posto = Posto::find($request->id);

        if (!isset($posto)) {
            return response()->json([
                'status' => false,
                'message' => "Posto não encontrado"
            ]);
        }
        if (isset($request->nome)) {
            $posto->nome = $request->nome;
        }

        if (isset($request->cep)) {
            $posto->cep = $request->cep;
        }

        
        if (isset($request->estado)) {
            $posto->estado = $request->estado;
        }

        
        if (isset($request->rua)) {
            $posto->rua = $request->rua;
        }

        
        if (isset($request->numero)) {
            $posto->numero = $request->numero;
        }

        if (isset($request->horarioFuncionamento)) {
            $posto->horarioFuncionamento = $request->horarioFuncionamento;
        }

        if (isset($request->diaFuncionamento)) {
            $posto->diaFuncionamento = $request->diaFuncionamento;
        }

        if (isset($request->servicos)) {
            $posto->servicos = $request->servicos;
        }

        $endereco = "{$request->cep}, {$request->estado}, {$request->rua}, {$request->numero}";
        if (isset($endereco)) {
            $geocodingService = new GeocodingService();
            $coordinates = $geocodingService->getCoordinates($endereco);
            
            if (!$coordinates) {
                return response()->json([
                    'success' => false,
                    'message' => 'Não foi possível obter as coordenadas do endereço fornecido.',
                ], 400);
            }
            
            $posto->latitude = $coordinates['lat'];
            $posto->longitude = $coordinates['lng'];
        }

    
        $posto->update();

        return response()->json([
            'status' => true,
            'message' => "Posto atualizado com sucesso",
            'data' => $posto
        ]);
    }
}


