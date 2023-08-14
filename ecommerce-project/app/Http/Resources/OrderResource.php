<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'sub total' => $this->sub_total,
            'total price' => $this->total_price,
            'payment_method' => $this->payment_method,
            'status' => $this->status,
            'items' => OrderVariantResource::collection($this->variants),
        ];
    }
}
