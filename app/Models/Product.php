<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Product extends Model
{
    protected $guarded = [];
    
    public function product_groups(): BelongsTo
    {
        return $this->belongsTo(ProductGroup::class);
    }

    public function product_units(): BelongsTo
    {
        return $this->belongsTo(ProductUnit::class);
    }

    public function sales_order_details(): HasMany
    {
        return $this->hasMany(SalesOrderDetail::class);
    }

    public function purchase_order_details(): HasMany
    {
        return $this->hasMany(PurchaseOrderDetail::class);
    }

    public function sales_return_details(): HasMany
    {
        return $this->hasMany(SalesReturnDetail::class);
    }

    public function stock_adjustments(): HasMany
    {
        return $this->hasMany(StockAdjustment::class);
    }
}
