<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Jobs\PrepareIngredients;
use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function store()
    {
        $response = Http::get(env('RECIPES_HOST') . '/recipes/random');
        $recipeId = $response['id'];
        $order = Order::create([
            'recipe_id' => $recipeId,
            'status' => OrderStatus::Preparing
        ]);

        PrepareIngredients::dispatch($response['ingredients'], $order->id);

        return response()->json($order, 201);
    }

    public function index()
{
    $orders = Order::all();

    foreach ($orders as $key => $order) {
        try {
            $response = Http::get(env('RECIPES_HOST') . '/recipes/' . $order->recipe_id)->json();
            $orders[$key]['recipe'] = $response['name'];

            $orders[$key]['status'] = OrderStatus::getDescription($order->status);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    return response()->json($orders, 200);
}


    public function orderReady(Order $order)
    {
        $order->status = OrderStatus::Ready;
        $order->save();
    }
}
