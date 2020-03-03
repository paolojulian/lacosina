<?php

namespace Tests\Feature;

use App\Procedure;
use Tests\TestCase;
use Illuminate\Support\Str;

class ProcedureCRUDTest extends TestCase
{
    public function testFetchAllIngredients__success(): void
    {
        $expect = Procedure::count();
        $response = $this->get('/api/procedures');

        $response
            ->assertStatus(200)
            ->assertJsonCount($expect);
    }

    public function testFetchExistingProcedure__success(): void
    {
        $response = $this->get('/api/procedures/1');
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'description',
                'image',
                'duration_from_minute',
                'duration_to_minute',
                'created_at',
                'updated_at'
            ]);
    }

    public function testFetchExistingProcedure__notFound(): void
    {
        $response = $this->get('/api/procedures/239120321');
        $response
            ->assertStatus(404)
            ->assertJson([
                'error' => 'Resource not found.'
            ]);
    }

    public function testMakeEmptyProcedure__validation(): void
    {
        $this->json('POST', '/api/procedures')
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['Procedure name is required.'],
                    'duration_to_minute' => ['Duration end is required.']
                ]
            ]);
    }

    public function testMakeInvalidDuration__validation(): void
    {
        $procedures = [
            'duration_from_minute' => 10,
            'duration_to_minute' => 5
        ];
        $this->json('POST', '/api/procedures', $procedures)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'duration_to_minute' => ['(Duration to) must not be lower than (duration from).']
                ]
            ]);
    }

    public function testMakeMaxCharProcedure__validation(): void
    {
        $payload = [
            'name' => Str::random(256),
            'description' => Str::random(1001),
        ];
        $this->json('POST', '/api/procedures', $payload)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['The name may not be greater than 255 characters.'],
                    'description' => ['The description may not be greater than 1000 characters.'],
                ]
            ]);
    }

    public function testUniqueName__validation(): void
    {
        $payload = [
            'name' => 'Sautee' // Existing
        ];
        $this->json('POST', '/api/procedures', $payload)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['The name has already been taken.'],
                ]
            ]);
    }

    public function testStore__success(): void
    {
        $faker = \Faker\Factory::create();
        $payload = [
            'name' => 'TestStoreProcedure',
            'description' => $faker->sentence(),
            'duration_from_minute' => 20,
            'duration_to_minute' => 25,
        ];
        $this->json('POST', '/api/procedures', $payload)
            ->assertStatus(201)
            ->assertJsonStructure([
                'name',
                'description',
                'duration_from_minute',
                'duration_to_minute',
            ]);
    }

    public function testUpdateWithEmptyFields__validation(): void
    {
        $payload = [
            'name' => '',
        ];
        $this->json('PUT', '/api/procedures/1', $payload)
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'name' => ['Procedure name is required.'],
                    'duration_to_minute' => ['Duration end is required.']
                ]
            ]);
    }

    public function testUpdateWithDuplicateName__validation(): void
    {
        $payload = [
            'name' => 'Deep Fry',
        ];
        $this->json('PUT', '/api/procedures/1', $payload)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['The name has already been taken.'],
                ]
            ]);
    }

    public function testUpdateMaxChar__validation(): void
    {
        $payload = [
            'name' => Str::random(256),
            'description' => Str::random(1001),
        ];
        $this->json('PUT', '/api/procedures/1', $payload)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['The name may not be greater than 255 characters.'],
                    'description' => ['The description may not be greater than 1000 characters.'],
                ]
            ]);
    }

    public function testUpdateWithSameName__success(): void
    {
        $payload = [
            'name' => 'Sautee',
            'description' => 'New Description',
            'duration_from_minute' => 10,
            'duration_to_minute' => 15,
        ];
        $this->json('PUT', '/api/procedures/1', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'name',
                'description',
                'duration_from_minute',
                'duration_to_minute',
            ]);
    }

    public function testUpdateWithMaxChar__success(): void
    {
        $payload = [
            'name' => Str::random(255),
            'description' => Str::random(1000),
            'duration_from_minute' => 10,
            'duration_to_minute' => 15,
        ];
        $this->json('PUT', '/api/procedures/1', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'name',
                'description',
                'duration_from_minute',
                'duration_to_minute',
            ]);
    }

    public function testDeleteNonExisting__shouldNotFound(): void
    {
        $this->json('DELETE', '/api/procedures/1230921')
            ->assertStatus(404);
    }
}
