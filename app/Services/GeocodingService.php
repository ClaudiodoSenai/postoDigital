<?php

namespace App\Services;

use GuzzleHttp\Client;

class GeocodingService
{
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = env('GOOGLE_MAPS_API_KEY'); // Acessando a chave da API do Google Maps de forma segura
    }

    public function getCoordinates(string $address): ?array
    {
        $client = new Client();
        $response = $client->get("https://maps.googleapis.com/maps/api/geocode/json", [
            'query' => [
                'address' => $address,
                'key' => $this->apiKey
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        if ($data['status'] === 'OK' && isset($data['results'][0]['geometry']['location'])) {
            $location = $data['results'][0]['geometry']['location'];
            return ['lat' => $location['lat'], 'lng' => $location['lng']];
        }

        // Adicionando um log de erro para facilitar a depuração
        \Log::error('Falha ao obter coordenadas para o endereço: ' . $address);

        return null;
    }
}
