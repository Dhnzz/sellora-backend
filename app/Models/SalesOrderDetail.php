<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalesOrderDetail extends Model
{
    protected $guarded = [];

    public function sales_orders(): BelongsTo
    {
        return $this->belongsTo(SalesOrder::class);
    }
    
    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
