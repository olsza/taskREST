<?php

use App\Services\PetstoreService;
use App\Repositories\PetstoreRepository;

$allPets = [
    ['id' => 1, 'name' => 'Olsza', 'status' => 'ok'],
    ['id' => 2, 'name' => 'Dog', 'status' => 'available'],
    ['id' => 3, 'name' => 'Cat', 'status' => 'available'],
    ['id' => 4, 'name' => 'Parrot', 'status' => 'pending'],
    ['id' => 5, 'name' => 'Fish', 'status' => 'sold'],
    ['id' => 6, 'name' => 'Hamster', 'status' => 'pending'],
    ['id' => 7, 'name' => 'Turtle', 'status' => 'available'],
];

describe('PetstoreService', function () use ($allPets) {
    beforeEach(function () {
        $this->mockRepository = mock(PetstoreRepository::class);
        $this->service = new PetstoreService($this->mockRepository);
    });

    it('returns available pets', function () use ($allPets) {
        $expected = array_values(array_filter($allPets, fn($pet) => $pet['status'] === 'available'));
        $this->mockRepository
            ->shouldReceive('getPets')
            ->with('available')
            ->once()
            ->andReturn($expected);
        $result = $this->service->getAvailablePets();
        expect($result)->toBe($expected);
    });

    it('returns pending pets', function () use ($allPets) {
        $expected = array_values(array_filter($allPets, fn($pet) => $pet['status'] === 'pending'));
        $this->mockRepository
            ->shouldReceive('getPets')
            ->with('pending')
            ->once()
            ->andReturn($expected);
        $result = $this->service->getPendingPets();
        expect($result)->toBe($expected);
    });

    it('returns sold pets', function () use ($allPets) {
        $expected = array_values(array_filter($allPets, fn($pet) => $pet['status'] === 'sold'));
        $this->mockRepository
            ->shouldReceive('getPets')
            ->with('sold')
            ->once()
            ->andReturn($expected);
        $result = $this->service->getSoldPets();
        expect($result)->toBe($expected);
    });

    it('returns pets by status (valid status)', function () use ($allPets) {
        $expected = array_values(array_filter($allPets, fn($pet) => $pet['status'] === 'pending'));
        $this->mockRepository
            ->shouldReceive('getPets')
            ->with('pending')
            ->once()
            ->andReturn($expected);
        $result = $this->service->getPetsByStatus('pending');
        expect($result)->toBe($expected);
    });

    it('returns pets by status (invalid status falls back to available)', function () use ($allPets) {
        $expected = array_values(array_filter($allPets, fn($pet) => $pet['status'] === 'available'));
        $this->mockRepository
            ->shouldReceive('getPets')
            ->with('available')
            ->once()
            ->andReturn($expected);
        $result = $this->service->getPetsByStatus('notastatus');
        expect($result)->toBe($expected);
    });

    it('returns empty array for status with no pets', function () use ($allPets) {
        $this->mockRepository
            ->shouldReceive('getPets')
            ->with('available')
            ->once()
            ->andReturn([]);
        $result = $this->service->getPetsByStatus('ghost');
        expect($result)->toBeArray()->toBeEmpty();
    });
});
