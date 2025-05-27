<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\SalesResource;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SalesOrderResource extends JsonResource
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
            'invoice_number' => $this->invoice_number,
            'customer_id' => new CustomerResource($this->whenLoaded('customers')),
            'sales_id' => new SalesResource($this->whenLoaded('sales')),
            'order_date' => $this->order_date,
            'total_amount' => (double) $this->total_amount,
            'status' => $this->status,
            'notes' => $this->notes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
