<?php

namespace App\Services;

use App\Repositories\PetstoreRepository;

/**
 * Service for retrieving pets from the Petstore API by status.
 *
 * Provides methods to fetch pets with status: available, pending, or sold.
 */
class PetstoreService
{
    /**
     * @var PetstoreRepository
     */
    protected PetstoreRepository $repository;

    /**
     * PetstoreService constructor.
     *
     * @param PetstoreRepository $repository
     */
    public function __construct(PetstoreRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get pets by status (available, pending, sold).
     * If an invalid status is provided, defaults to 'available'.
     *
     * @param string $status
     * @return array
     */
    public function getPetsByStatus(string $status = 'available')
    {
        if (!in_array($status, ['available', 'pending', 'sold'])) {
            $status = 'available';
        }
        return $this->repository->getPets($status);
    }

    /**
     * Get pets with status 'available'.
     *
     * @return array
     */
    public function getAvailablePets()
    {
        return $this->getPetsByStatus('available');
    }

    /**
     * Get pets with status 'pending'.
     *
     * @return array
     */
    public function getPendingPets()
    {
        return $this->getPetsByStatus('pending');
    }

    /**
     * Get pets with status 'sold'.
     *
     * @return array
     */
    public function getSoldPets()
    {
        return $this->getPetsByStatus('sold');
    }
}
