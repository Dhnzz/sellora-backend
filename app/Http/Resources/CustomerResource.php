<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
            'user_id' => new UserResource($this->whenLoaded('users')),
            'credit_limit' => (double) $this->credit_limit,
            'payment_term' => (int) $this->payment_term,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
