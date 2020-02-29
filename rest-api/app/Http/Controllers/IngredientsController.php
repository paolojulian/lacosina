<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIngredientRequest;
use App\Http\Requests\UpdateIngredientRequest;
use App\Ingredient;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @api
 * @todo TODO - Select fields, transfer to service layer validations
 * BaseUrl: /ingredients
 */
class IngredientsController extends Controller
{
    /**
     * [GET] - /
     * Retrieves all ingredients
     *
     * @return array - Array of Ingredients
     */
    public function index(): Collection
    {
        return Ingredient::all();
    }

    /**
     * [GET] - /{id}
     * Retrieves an ingredient based on the passed id
     *
     * @return Ingredient
     */
    public function details(Ingredient $ingredient): Ingredient
    {
        return $ingredient;
    }

    /**
     * [POST] - /
     * Save an ingredient
     *
     * @return JsonResponse - 201 Created
     */
    public function store(StoreIngredientRequest $request): JsonResponse
    {
        $ingredient = Ingredient::create($request->validated());

        return response()->json($ingredient, 201);
    }

    /**
     * [PUT] - /{ingredient}
     * Updates the ingredient
     *
     * @return JsonResponse - 200 OK
     */
    public function update(StoreIngredientRequest $request, Ingredient $ingredient): JsonResponse
    {
        $ingredient->update($request->validated());

        return response()->json($ingredient, 200);
    }

    /**
     * [DELETE] - /{ingredient}
     * Delete an ingredient
     *
     * @return JsonResponse - 204 No Content
     */
    public function delete(Ingredient $ingredient): JsonResponse
    {
        $ingredient->delete();

        return response()->json(null, 204);
    }
}
