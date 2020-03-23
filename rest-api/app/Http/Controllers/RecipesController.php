<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecipeRequest;
use App\Recipe;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

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
    public function index(): LengthAwarePaginator
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
     * [POST] - /{recipe}
     * Save a recipe
     */
    public function store(StoreRecipeRequest $request): JsonResponse
    {
        $recipe = Recipe::create($request->validated());

        return response()->json($recipe, 201);
    }
}
