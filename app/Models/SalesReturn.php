<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class SalesReturn extends Model
{
    protected $guarded = [];

    public function sales_orders(): BelongsTo
    {
        return $this->belongsTo(SalesOrder::class);
    }

    public function sales_return_details(): HasMany
    {
        return $this->hasMany(SalesReturnDetail::class);
    }
}
