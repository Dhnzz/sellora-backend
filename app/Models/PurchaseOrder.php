<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class PurchaseOrder extends Model
{
    protected $guarded = [];

    public function suppliers(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchase_order_details(): HasMany
    {
        return $this->hasMany(PurchaseOrderDetail::class);
    }
}
