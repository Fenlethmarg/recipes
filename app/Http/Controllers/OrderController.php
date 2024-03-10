<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Recipe;
use App\Models\Stock;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function store()
    {
        $recipe = Recipe::all()->random();

        $order = Order::create([
            'recipe_id' => $recipe->id,
            'status' => OrderStatus::Waiting
        ]);

        // Pedir a la bodega de alimentos los ingredientes para preparar el plato seleccionado
        foreach ($recipe->ingredients as $ingredient) {
            $stock = Stock::where('ingredient_id', $ingredient->id)->first();

            while ($stock->quantity < $ingredient->pivot->quantity) {
                // Si no hay suficientes ingredientes en stock, hacer un pedido a la plaza de mercado
                $response = Http::get('https://recruitment.alegra.com/api/farmers-market/buy', [
                    'ingredient' => strtolower($ingredient->name),
                ]);

                $data = $response->json();

                if ($data['quantitySold'] > 0) {
                    // Si la compra fue exitosa, actualizar el stock
                    $stock->quantity += $data['quantitySold'];
                    $stock->save();
                } // VER que pasa si no hay. Que usar? jobs?.
            }
            $stock->quantity -= $ingredient->pivot->quantity;
            $stock->save();
        }

        $order->status = OrderStatus::Preparing;
        $order->save();
        $order->recipe;

        return response()->json($order, 201);
    }

    public function index()
    {
        return response()->json(Order::with('recipe')->get(), 200);
    }
}
