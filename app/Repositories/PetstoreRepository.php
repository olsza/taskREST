<?php

namespace App\Repositories;

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
}

