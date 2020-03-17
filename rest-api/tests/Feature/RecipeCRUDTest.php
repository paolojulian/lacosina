<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecipeCRUDTest extends TestCase
{
    public function testStore__validateEmptyFields(): void
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
}
