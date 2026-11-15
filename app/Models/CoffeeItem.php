<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoffeeItem extends Model
{
    protected $fillable = [
        'name', 'slug', 'category', 'description', 'tasting_notes', 'size',
        'price', 'image_url', 'is_featured', 'is_available', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'is_featured' => 'boolean',
            'is_available' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function orderLines()
    {
        return $this->hasMany(CafeOrderLine::class);
    }
}
