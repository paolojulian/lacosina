<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecipesCRUDTest extends TestCase
{
    public function testPaginateRecipes__success()
    {
        $response = $this->get('/recipes');
        $response
            ->assertStatus(200)
            ->assertJsonCount(8)
            ->assertJsonStructure([
                'id',
                'name',
                'description',
                'duration_from_minutes',
                'duration_to_minutes',
                'procedures',
                'ingredients'
            ]);
    }
}
