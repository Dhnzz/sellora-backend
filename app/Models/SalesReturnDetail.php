<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalesReturnDetail extends Model
{
    protected $guarded = [];

    public function sales_returns(): BelongsTo
    {
        return $this->belongsTo(SalesReturn::class);
    }

    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    
}
