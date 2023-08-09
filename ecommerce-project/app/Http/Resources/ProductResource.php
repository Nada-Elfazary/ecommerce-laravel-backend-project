<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\OptionResource;

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
            'title' => $this->title,
            'average rating' => $this->average_rating,
            'options' => OptionResource::collection($this->options()->get()),
            'default variant' => $this->defaultVariant($this->id),
           // 'is_in_stock' => $this->inStock($this->variants),
        ];
    }
}
