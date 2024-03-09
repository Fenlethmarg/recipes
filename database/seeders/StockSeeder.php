<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Stock;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredients = Ingredient::all();
        foreach ($ingredients as $ingredient) {
            Stock::create(['ingredient_id' => $ingredient->id, 'quantity' => 5]);
        }
    }
}
