<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockAdjustment extends Model
{
    protected $guarded = [];

    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function admins(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

}
