<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseOrderDetail extends Model
{
    protected $guarded = [];

    public function purchase_orders(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
    
    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
