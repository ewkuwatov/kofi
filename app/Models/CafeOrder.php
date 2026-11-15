<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CafeOrder extends Model
{
    public const STATUSES = [
        'new' => 'Новый',
        'preparing' => 'Готовим',
        'ready' => 'Можно забирать',
        'completed' => 'Выдан',
        'cancelled' => 'Отменён',
    ];

    protected $fillable = [
        'uuid', 'customer_name', 'phone', 'email', 'pickup_slot', 'comment', 'status', 'total',
    ];

    protected function casts(): array
    {
        return ['total' => 'integer'];
    }

    public function lines(): HasMany
    {
        return $this->hasMany(CafeOrderLine::class);
    }
}
