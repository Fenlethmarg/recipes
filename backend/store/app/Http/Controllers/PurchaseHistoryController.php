<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PurchaseHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PurchaseHistoryController extends Controller
{
    public function index()
    {
        $purchaseHistories = PurchaseHistory::all();
        foreach($purchaseHistories as $key => $purchaseHistory) {
            $purchaseHistories[$key]['ingredient'] = Http::get(env('RECIPES') . '/ingredients/' . $purchaseHistory->ingredient_id)->json();
        }
        return response()->json($purchaseHistories);
    }
}
