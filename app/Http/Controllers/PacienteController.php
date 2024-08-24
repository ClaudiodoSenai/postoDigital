<?php

namespace App\Http\Controllers;

use App\Http\Requests\PacienteFormRequest;
use App\Models\Paciente;
use App\Models\Posto;
use App\Services\GeocodingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PacienteController extends Controller
{



    public function criarPaciente(PacienteFormRequest $request)
    {
        function calcularDistancia($lat1, $lon1, $lat2, $lon2)
        {
            $raioTerra = 6371; // Raio médio da Terra em km

            $dLat = deg2rad($lat2 - $lat1);
            $dLon = deg2rad($lon2 - $lon1);

            $a = sin($dLat / 2) * sin($dLat / 2) +
                cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
                sin($dLon / 2) * sin($dLon / 2);
            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
            $distancia = $raioTerra * $c;

            return $distancia;
        }

        $enderecoCompleto = "{$request->cep}, {$request->estado}, {$request->rua}, {$request->numero}";
        $geocodingService = new GeocodingService();
        $coordinates = $geocodingService->getCoordinates($enderecoCompleto);

        if (!$coordinates) {
            return response()->json([
                'success' => false,
                'message' => 'Não foi possível obter as coordenadas do endereço fornecido.',
            ], 400);
        }


        $pacienteLatitude = $coordinates['lat'];
        $pacienteLongitude = $coordinates['lng'];


        $postos = Posto::all();
        $distancias = [];
        foreach ($postos as $posto) {
            $distancia = calcularDistancia($pacienteLatitude, $pacienteLongitude, $posto->latitude, $posto->longitude);
            $distancias[$posto->id] = $distancia;
        }

        $postoMaisProximoId = array_keys($distancias, min($distancias))[0];

        $paciente = Paciente::create([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'email' => $request->email,
            'rua' => $request->rua,
            'numero' => $request->numero,
            'estado' => $request->estado,
            'cep' => $request->cep,
            'celular' => $request->celular,
            'senha' => Hash::make($request->senha),
            'id_postos' => $postoMaisProximoId,
            'latitude' => $coordinates['lat'],
            'longitude' => $coordinates['lng'],
        ]);

        return response()->json([
            "success" => true,
            "message" => "Paciente cadastrado com sucesso",
            "data" => $paciente
        ], 200);
    }

    public function retornarTodos()
    {
        $pacientes = Paciente::all();
        return response()->json([
            'status' => true,
            'data' => $pacientes
        ]);
    }
}
