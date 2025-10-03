<?php

namespace App\Repositories;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class PetstoreRepository
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('petstore.base_url');
    }

    public function getPets(string $status = 'available')
    {
        $response = Http::get($this->baseUrl . '/pet/findByStatus', [
            'status' => $status,
        ]);
        return $response->json();
    }

    /**
     * Add a new pet to the Petstore API.
     * @param array $data
     * @return array|null
     */
    public function addPet(array $data)
    {
        $baseUrl = config('petstore.base_url');
        $url = rtrim($baseUrl, '/') . '/pet';
        $client = new Client();
        try {
            $response = $client->post($url, [
                'json' => $data,
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);
            $body = json_decode($response->getBody()->getContents(), true);
            return $body;
        } catch (\Exception $e) {
            return null;
        }
    }

