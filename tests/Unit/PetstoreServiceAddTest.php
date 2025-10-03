<?php

use App\Services\PetstoreService;
use App\Repositories\PetstoreRepository;

describe('PetstoreService add', function () {
    beforeEach(function () {
        $this->mockRepository = mock(PetstoreRepository::class);
        $this->service = new PetstoreService($this->mockRepository);
    });

    it('adds a new pet with name Olsza', function () {
        $petData = [
            'name' => 'Olsza',
            'status' => 'available',
        ];
        $apiResponse = [
            'id' => 987654,
            'name' => 'Olsza',
            'status' => 'available',
        ];
        $this->mockRepository
            ->shouldReceive('addPet')
            ->with($petData)
            ->once()
            ->andReturn($apiResponse);
        $result = $this->service->addPet('Olsza', 'available');
        expect($result)->toBe($apiResponse);
    });

    it('returns null if API add fails', function () {
        $petData = [
            'name' => 'Olsza',
            'status' => 'available',
        ];
        $this->mockRepository
            ->shouldReceive('addPet')
            ->with($petData)
            ->once()
            ->andReturn(null);
        $result = $this->service->addPet('Olsza', 'available');
        expect($result)->toBeNull();
    });
});

