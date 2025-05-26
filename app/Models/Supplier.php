<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    protected $guarded = [];

    public function purchase_orders(): HasMany
    {
        return $this->hasMany(PurchaseOrder::class);
    }
}
