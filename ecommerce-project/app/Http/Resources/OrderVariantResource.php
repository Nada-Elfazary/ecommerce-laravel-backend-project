<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderVariantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        echo $this->variants;
        $order_id = explode('/', $_SERVER['REQUEST_URI'])[4];
        $order = $this->orders->where('id', $order_id)->first();
        return [
            'skuid' => $this->skuid,
            'title' => $this->title,
            'option1 value' => $this->option1,
            'option2 value' => $this->option2,
            'unit price' => $this->price,
            'quantity' => $order->content->quantity,
        ];
    }
}
