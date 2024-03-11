<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Recipe;

class RecipeController extends Controller
{
    public function getRandom()
    {
        $recipe = Recipe::all()->random();
        $recipe->ingredients;
        return response()->json($recipe);
    }

    public function show(Recipe $recipe)
    {
        $recipe->ingredients;
        return response()->json($recipe);
    }

    public function index()
    {
        return response()->json(Recipe::with('ingredients')->get());
    }
}
