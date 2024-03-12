<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Jobs\PurchaseIngredients;
use App\Models\PurchaseHistory;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StockController extends Controller
{
    public function prepareIngredients(Request $request) 
    {
        PurchaseIngredients::dispatch($request['ingredients'], $request['orderId']);
        return response()->json(['success'=>true]);
    }
    
    public function index() 
    {
        $stocks = [];
        try {
            $ingredients = Http::get(env('RECIPES_HOST') . '/ingredients');
            foreach ($ingredients->json() as $key => $ingredient) {
                $stocks[$key] = Stock::where('ingredient_id', $ingredient['id'])->first();
                $stocks[$key]['ingredient'] = $ingredient;
            }
            return response()->json($stocks);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
