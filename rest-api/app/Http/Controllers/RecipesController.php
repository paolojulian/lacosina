<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

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
}
