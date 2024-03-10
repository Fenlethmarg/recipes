<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'status',
        'recipe_id',
    ];

    protected $casts = [
        'status' => OrderStatus::class,
    ];

    /**
     * Get the recipe associated with the order.
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function getStatusAttribute($value)
    {
        return OrderStatus::getDescription($value);
    }
}
