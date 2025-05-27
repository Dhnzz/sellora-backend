<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\SalesOrderResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SalesReturnResource extends JsonResource
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
            'return_number' => $this->return_number,
            'sales_order_id' => new SalesOrderResource($this->whenLoaded('sales_orders')),
            'return_date' => $this->return_date,
            'total_refund' => (double) $this->total_refund,
            'reason' => $this->reason,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
