<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Seeder;

class RecipeAndIngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // It was decided to do the ingredients and the recipes in the same seeder 
        // to facilitate the access of ingredients to their respective recipes.

        //Ingredients
        $tomato = Ingredient::create(['name' => "Tomato"]);
        $lemon = Ingredient::create(['name' => "Lemon"]);
        $potato = Ingredient::create(['name' => "Potato"]);
        $rice = Ingredient::create(['name' => "Rice"]);
        $ketchup = Ingredient::create(['name' => "Ketchup"]);
        $lettuce = Ingredient::create(['name' => "Lettuce"]);
        $onion = Ingredient::create(['name' => "Onion"]);
        $cheese = Ingredient::create(['name' => "Cheese"]);
        $meat = Ingredient::create(['name' => "Meat"]);
        $chicken = Ingredient::create(['name' => "Chicken"]);

        //Recipes
        $potatoCake = Recipe::create(['name' => 'Potato Cake']);
        $potatoCake->ingredients()->attach($potato->id, ['quantity' => 2]);
        $potatoCake->ingredients()->attach($meat->id, ['quantity' => 2]);
        $potatoCake->ingredients()->attach($cheese->id, ['quantity' => 1]);
        $potatoCake->ingredients()->attach($onion->id, ['quantity' => 1]);
        
        $salad = Recipe::create(['name' => 'Salad']);
        $salad->ingredients()->attach($lettuce->id, ['quantity' => 2]);
        $salad->ingredients()->attach($tomato->id, ['quantity' => 2]);
        $salad->ingredients()->attach($lemon->id, ['quantity' => 1]);
        
        $chickenTikkaMasala = Recipe::create(['name' => 'Chicken Tikka Masala']);
        $chickenTikkaMasala->ingredients()->attach($rice->id, ['quantity' => 2]);
        $chickenTikkaMasala->ingredients()->attach($chicken->id, ['quantity' => 2]);
        $chickenTikkaMasala->ingredients()->attach($lemon->id, ['quantity' => 1]);
        $chickenTikkaMasala->ingredients()->attach($onion->id, ['quantity' => 1]);
        
        $bunlessBurger = Recipe::create(['name' => 'Bunless Burger']);
        $bunlessBurger->ingredients()->attach($lettuce->id, ['quantity' => 1]);
        $bunlessBurger->ingredients()->attach($tomato->id, ['quantity' => 1]);
        $bunlessBurger->ingredients()->attach($meat->id, ['quantity' => 1]);
        $bunlessBurger->ingredients()->attach($cheese->id, ['quantity' => 1]);
        $bunlessBurger->ingredients()->attach($onion->id, ['quantity' => 1]);
        $bunlessBurger->ingredients()->attach($ketchup->id, ['quantity' => 1]);
        $bunlessBurger->ingredients()->attach($potato->id, ['quantity' => 1]);
        
        $chickenSalad = Recipe::create(['name' => 'Chicken Salad']);
        $chickenSalad->ingredients()->attach($chicken->id, ['quantity' => 1]);
        $chickenSalad->ingredients()->attach($lemon->id, ['quantity' => 1]);
        $chickenSalad->ingredients()->attach($lettuce->id, ['quantity' => 1]);
        $chickenSalad->ingredients()->attach($tomato->id, ['quantity' => 1]);
        $chickenSalad->ingredients()->attach($cheese->id, ['quantity' => 1]);
        $chickenSalad->ingredients()->attach($onion->id, ['quantity' => 1]);
        
        $ketchupRice = Recipe::create(['name' => 'Ketchup Fried Rice']);
        $ketchupRice->ingredients()->attach($rice->id, ['quantity' => 2]);
        $ketchupRice->ingredients()->attach($onion->id, ['quantity' => 1]);
        $ketchupRice->ingredients()->attach($ketchup->id, ['quantity' => 2]);
        $ketchupRice->ingredients()->attach($chicken->id, ['quantity' => 1]);
    }
}
