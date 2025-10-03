<?php

namespace App\Services;

use App\Repositories\PetstoreRepository;

class PetstoreService
{
    protected PetstoreRepository $repository;

    public function __construct(PetstoreRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAvailablePets()
    {
        return $this->repository->getPets('available');
    }
}
