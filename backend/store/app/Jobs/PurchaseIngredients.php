<?php

namespace App\Jobs;

use App\Models\Ingredient;
use App\Models\PurchaseHistory;
use App\Models\Stock;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PurchaseIngredients implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 10;
    protected $ingredients;
    protected $orderId;

    public function __construct($ingredients, $orderId)
    {
        $this->ingredients = $ingredients;
        $this->orderId = $orderId;
    }

    public function handle()
    {
        Log::info('JOB Despachado');
        $preparedIngredients = [];
        foreach ($this->ingredients as $ingredient) {
            $quantityNeeded = $ingredient["pivot"]['quantity'];           
            $stock = Stock::where('ingredient_id', $ingredient['id'])->first();
    
            if ($stock->quantity < $quantityNeeded) {
                Log::info('Comprando: ' . $ingredient['name']);
                $data = $this->purchaseFood($ingredient['name']);
                PurchaseHistory::create(['quantity' => $data['quantitySold'], 'ingredient_id' => $ingredient['id']]);
    
                if ($data['quantitySold'] > 0) {
                    $stock->quantity += $data['quantitySold'];
                    if ($stock->quantity >= $quantityNeeded) {
                        $preparedIngredients[] = $ingredient;
                    } else {
                        Log::info('No alcanzó ' . $ingredient['name']);
                        // Si aun no alcanza con la compra para preparar la receta vuelve a comprar
                        $this->release(3);
                    }
                    $stock->save();
                } else {
                    // Si el ingrediente no está disponible, reprogramar el job para que se ejecute en 30 segundos
                    Log::info('La compra fue de 0 ' . $ingredient['name']);
                    $this->release(3);
                }
            } else {
                $preparedIngredients[] = $ingredient;
            }
        }
        if (count($preparedIngredients) == count($this->ingredients)) {
            foreach ($this->ingredients as $ingredient) {
                $quantityNeeded = $ingredient["pivot"]['quantity'];           
                $stock = Stock::where('ingredient_id', $ingredient['id'])->first();
                $stock->quantity -= $quantityNeeded;
                $stock->save();
            }
            Http::post(env('ORDERS_HOST') . '/orders/' . $this->orderId . '/ready');
        }
    }

    private function purchaseFood($ingredient)
    {
        $response = Http::withOptions(['verify' => false])->get('https://recruitment.alegra.com/api/farmers-market/buy', [
            'ingredient' => strtolower($ingredient),
        ]);
        return $response->json();
    }
}
