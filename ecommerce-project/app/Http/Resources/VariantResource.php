<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VariantResource extends JsonResource
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
            'skuid' => $this->skuid,
            'title' => $this->title,
            'option1 value' => $this->option1,
            'option2 value' => $this->option2,
            'price' => $this->price,
            'stock' => $this->stock,
            'is_in_stock' => $this->inStock($this->stock),
         
        ];
    }
}
