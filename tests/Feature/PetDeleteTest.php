<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PetDeleteTest extends TestCase
{
    public function test_delete_pet_removes_pet_and_redirects()
    {
        Http::fake([
            '*/pet/123' => Http::response([], 200),
            '*/pet/findByStatus*' => Http::sequence()
                ->push([
                    ['id' => 123, 'name' => 'TestPet', 'status' => 'available'],
                ], 200)
                ->push([], 200),
        ]);

        $response = $this->get('/?status=available');
        $pets = $response->viewData('pets');
        $this->assertNotEmpty($pets, 'Lista zwierząt powinna być niepusta');
        $this->assertEquals('TestPet', $pets[0]['name']);

        $response = $this->delete(route('pets.destroy', 123));
        $response->assertRedirect(route('home'));
        $response->assertSessionHas('success');

        $response = $this->get('/?status=available');
        $pets = $response->viewData('pets');
        $this->assertEmpty($pets, 'Lista zwierząt powinna być pusta po usunięciu');
    }

    public function test_delete_pet_handles_api_error()
    {
        Http::fake([
            '*/pet/123' => Http::response(['message' => 'Not found'], 404),
            '*/pet/findByStatus*' => Http::response([
                ['id' => 123, 'name' => 'TestPet', 'status' => 'available'],
            ], 200),
        ]);

        $response = $this->delete(route('pets.destroy', 123));
        $response->assertRedirect(route('home'));
        $response->assertSessionHas('error');
    }
}
