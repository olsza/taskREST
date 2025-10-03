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

    public function getPetById($id)
    {
        $baseUrl = config('petstore.base_url');
        $url = rtrim($baseUrl, '/') . '/pet/' . $id;
        $response = Http::get($url);
        if ($response->successful()) {
            return $response->json();
        }
        return null;
    }

    public function updatePet($id, $name, $status)
    {
        $baseUrl = config('petstore.base_url');
        $url = rtrim($baseUrl, '/') . '/pet';

        $current = $this->getPetById($id);
        if (!$current) {
            return false;
        }

        $data = $current;
        $data['name'] = $name;
        $data['status'] = $status;

        if (!isset($data['photoUrls'])) $data['photoUrls'] = [];
        if (!isset($data['tags'])) $data['tags'] = [];
        $response = Http::put($url, $data);
        return $response->successful();
    }

    public function updatePetFull(array $data)
    {
        $baseUrl = config('petstore.base_url');
        $url = rtrim($baseUrl, '/') . '/pet';

        if (!isset($data['photoUrls'])) $data['photoUrls'] = [];
        if (!isset($data['tags'])) $data['tags'] = [];
        $response = Http::put($url, $data);

        return $response->successful();
    }
}
