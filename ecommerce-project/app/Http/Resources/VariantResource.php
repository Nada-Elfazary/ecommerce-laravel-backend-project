<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

class VariantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $variant = [
            'id' => $this->id,
            'skuid' => $this->skuid,
            'title' => $this->title,
            'option1 value' => $this->option1,
            'option2 value' => $this->option2,
            'price' => $this->price,
            'stock' => $this->stock,
            'is_in_stock' => $this->inStock($this->stock),
        ];

        if (Route::current()->uri == "api/order/show/{order}") {
            $order_id = explode('/', $_SERVER['REQUEST_URI'])[4];
           // $variants = Order::with('variants')->find($order_id);
            $order = $this->orders->where('id', $order_id)->first();
            //$quantity = $order->pivot->quantity;
            $quantity = $order->content->quantity;
            $variant['quantity'] = $quantity;
            
        }

        return $variant;

    }
}
