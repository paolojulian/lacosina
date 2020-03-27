<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecipeRequest;
use App\Recipe;
use App\RecipeIngredient;
use App\RecipeProcedure;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

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
        $recipeData = $request->validated();
        return DB::transaction(function () use ($recipeData) {
            $recipe = Recipe::create($recipeData);

            foreach ($recipeData['ingredients'] as $ingredient) {
                $ingredient['recipe_id'] = $recipe->id;
                RecipeIngredient::create($ingredient);
            }

            foreach ($recipeData['procedures'] as $procedure) {
                $procedure['recipe_id'] = $recipe->id;
                RecipeProcedure::create($procedure);
            }

            return response()->json($recipe->id, 201);
        }, 2);
    }
}
