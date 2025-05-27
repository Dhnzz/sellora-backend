<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\AdminResource;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StockAdjustmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_id' => new ProductResource($this->whenLoaded('products')),
            'admin_id' => new AdminResource($this->whenLoaded('admins')),
            'type' => $this->type,
            'quantity' => (int) $this->quantity,
            'reason' => $this->reason,
            'adjustment_date' => $this->adjustment_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->id,
        ];
    }
}
