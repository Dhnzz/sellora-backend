<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SalesReturnResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SalesReturnDetailResource extends JsonResource
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
            'sales_return_id' => new SalesReturnResource($this->whenLoaded('sales_returns')),
            'product_id' => new ProductResource($this->whenLoaded('products')),
            'quantity' => (int) $this->quantity,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
