<?php

namespace Tests\Feature;

use App\Ingredient;
use Tests\TestCase;
use Illuminate\Support\Str;

class IngredientCRUDTest extends TestCase
{
    public function testFetchAllIngredients__success(): void
    {
        $expect = Ingredient::count();
        $response = $this->get('/api/ingredients');

        $response
            ->assertStatus(200)
            ->assertJsonCount($expect);
    }

    public function testFetchExistingIngredient__success(): void
    {
        $response = $this->get('/api/ingredients/1');
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'description',
                'category',
                'created_at',
                'updated_at'
            ]);
    }

    public function testFetchExistingIngredient__notFound(): void
    {
        $response = $this->get('/api/ingredients/239120321');
        $response
            ->assertStatus(404)
            ->assertJson([
                'error' => 'Resource not found.'
            ]);
    }

    public function testMakeEmptyIngredient__validation(): void
    {
        $this->json('POST', '/api/ingredients')
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['Ingredient name is required']
                ]
            ]);
    }

    public function testMakeMaxCharIngredient__validation(): void
    {
        $payload = [
            'name' => Str::random(256),
            'description' => Str::random(1001),
            'category' => Str::random(256),
        ];
        $this->json('POST', '/api/ingredients', $payload)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['The name may not be greater than 255 characters.'],
                    'description' => ['The description may not be greater than 1000 characters.'],
                    'category' => ['The category may not be greater than 255 characters.'],
                ]
            ]);
    }

    public function testUniqueName__validation(): void
    {
        $payload = [
            'name' => 'Salt' // Existing
        ];
        $this->json('POST', '/api/ingredients', $payload)
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
            'name' => 'aslkdjsakldjsa',
            'description' => $faker->sentence(),
            'category' => 'Base'
        ];
        $this->json('POST', '/api/ingredients', $payload)
            ->assertStatus(201)
            ->assertJsonStructure([
                'name',
                'description',
                'category'
            ]);
    }
}
