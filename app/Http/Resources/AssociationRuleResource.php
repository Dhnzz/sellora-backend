<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssociationRuleResource extends JsonResource
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
            'antecedent' => $this->antecedent,
            'consequent' => $this->consequent,
            'confidence' => $this->confidence,
            'support' => $this->support,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
