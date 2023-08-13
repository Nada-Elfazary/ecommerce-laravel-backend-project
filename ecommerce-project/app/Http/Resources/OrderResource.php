<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Route;


class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        
        $order = [
             'id' => $this->id,
             'sub total' => $this->sub_total,
             'total price' => $this->total_price,
             'payment_method' => $this->payment_method,
             'status' => $this->status,

         ];
       
        if (Route::current()->uri == "api/order/show/{order}") {
            $order['items'] = VariantResource::collection($this->variants);
        }

        return $order;
    }
}
