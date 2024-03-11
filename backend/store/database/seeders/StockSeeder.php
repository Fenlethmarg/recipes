<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Stock;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredients = Http::get('127.0.0.1:8002/ingredients');
        foreach ($ingredients->json() as $ingredient) {
            Stock::create(['ingredient_id' => $ingredient['id'], 'quantity' => 5]);
        }
    }
}
