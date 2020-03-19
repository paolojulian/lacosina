<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecipeRequest;
use App\Recipe;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

/**
 * @api
 * BaseUrl: /recipes
 */
class RecipesController extends Controller
{
    /**
     * [GET] - /
     * Paginates the recipes
     * :queryString
     *  -page
     */
    public function index(): Collection
    {
        return Recipe::paginate(10);
    }

    /**
     * [GET] - /{recipe}
     * Fetch single recipe
     */
    public function details(Recipe $recipe): Recipe
    {
        return $recipe;
    }

    /**
     * [GET] - /{recipe}
     * Save a recipe
     */
    public function store(StoreRecipeRequest $request): JsonResponse
    {
        $recipe = Recipe::create($request->validated());

        return response()->json($recipe, 201);
    }
}
