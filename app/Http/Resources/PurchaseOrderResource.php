<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\SupplierResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrderResource extends JsonResource
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
            'po_number' => $this->po_number,
            'supplier_id' => new SupplierResource($this->whenLoaded('suppliers')),
            'order_date' => $this->order_date,
            'total_amount' => (double) $this->total_amount,
            'status' => $this->status,
            'notes' => $this->notes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
