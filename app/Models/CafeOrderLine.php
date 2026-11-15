<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CafeOrderLine extends Model
{
    public $timestamps = false;

    protected $fillable = ['coffee_item_id', 'name', 'size', 'price', 'quantity'];

    protected function casts(): array
    {
        return ['price' => 'integer', 'quantity' => 'integer'];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(CafeOrder::class, 'cafe_order_id');
    }

    public function coffeeItem(): BelongsTo
    {
        return $this->belongsTo(CoffeeItem::class);
    }
}
