<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
