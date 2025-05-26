<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class SalesOrder extends Model
{
    protected $guarded = [];

    public function customers(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
    
    public function sales(): BelongsTo
    {
        return $this->belongsTo(Sales::class);
    }

    public function sales_order_details(): HasMany
    {
        return $this->hasMany(SalesOrderDetail::class);
    }

    public function sales_returns(): HasMany
    {
        return $this->hasMany(SalesReturn::class);
    }
}
