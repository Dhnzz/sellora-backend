<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\ProductUnitResource;
use App\Http\Resources\ProductGroupResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'sku' => $this->sku,
            'name' => $this->name,
            'description' => $this->description,
            'product_group_id' => new ProductGroupResource($this->whenLoaded('product_groups')),
            'product_unit_id' => new ProductUnitResource($this->whenLoaded('product_units')),
            'purchase_price' => (double) $this->purchase_price,
            'selling_price' => (double) $this->selling_price,
            'stock' => (int) $this->stock,
            'stock_alert' => (int) $this->stock_alert,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
