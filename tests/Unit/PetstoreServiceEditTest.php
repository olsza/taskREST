<?php

use App\Services\PetstoreService;
use App\Repositories\PetstoreRepository;
use Illuminate\Support\Facades\Http;

describe('PetstoreService edit', function () {
    beforeEach(function () {
        $this->mockRepository = mock(PetstoreRepository::class);
        $this->service = new PetstoreService($this->mockRepository);
    });

    it('updates pet with full structure', function () {
        $petData = [
            'id' => 123,
            'name' => 'Olsza to JA',
            'status' => 'available',
            'category' => ['id' => 1, 'name' => 'Tester'],
            'photoUrls' => ['https://olsza.czlowiek.it', 'url2-image'],
            'tags' => [
                ['id' => 1, 'name' => 'olo'],
                ['id' => 2, 'name' => 'olszaK'],
            ],
        ];
        $this->mockRepository
            ->shouldReceive('updatePetFull')
            ->with($petData)
            ->once()
            ->andReturn(true);
        $result = $this->service->updatePetFull($petData);
        expect($result)->toBeTrue();
    });

    it('returns false if update fails', function () {
        $petData = [
            'id' => 123,
            'name' => 'Olsza to Nie JA',
            'status' => 'available',
            'category' => ['id' => 1, 'name' => 'Tester'],
            'photoUrls' => ['url1'],
            'tags' => [],
        ];
        $this->mockRepository
            ->shouldReceive('updatePetFull')
            ->with($petData)
            ->once()
            ->andReturn(false);
        $result = $this->service->updatePetFull($petData);
        expect($result)->toBeFalse();
    });
});
