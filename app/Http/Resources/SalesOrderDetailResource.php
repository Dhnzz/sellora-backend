<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SalesOrderResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SalesOrderDetailResource extends JsonResource
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
            'sales_order_id' => new SalesOrderResource($this->whenLoaded('sales_orders')),
            'product_id' => new ProductResource($this->whenLoaded('products')),
            'quantity' => (int) $this->quantity,
            'price' => (double) $this->price,
            'subtotal' => (double) $this->subtotal,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
