<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Admin extends Model
{
    protected $guarded = [];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function stock_adjustments(): HasMany
    {
        return $this->hasMany(StockAdjustment::class);
    }
}
