<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Variant;
use App\Http\Resources\OrdersResource;
use App\Http\Resources\OrderResource;
use DB;

class OrderController extends Controller
{
    public function index() {
        $user = Auth::user();

        $orders = $user->orders;
        
        return OrdersResource::collection($orders);
       /*return response()->json([
            'orders' => $orders
        ]);*/
        
    }

    public function show(Order $order) {
        return new OrderResource($order);
    }

    public function create() {
        $user = Auth::user();
        $attributes = $this->validateOrder();
        $items = array_pop($attributes);

      //  $variant_ids = explode(',', $variant_ids);
      // $variant_qty = explode(',', $variant_qty);

        $order = Order::create(array_merge($attributes, [ 
            'user_id' => $user->id,
        ]));
        
        foreach($items as $key=>$value) {
            $curr_price = Variant::find($key)->get()->first()->price;
            $order->variants()->attach($key,[
               'quantity' => $value,
               'unit_price' => $curr_price,
            ]);
            Variant::find($key)->decrement('stock', $value);
        }

        return response()->json([
            'message' => 'order successfully created',
        ]);
        
    }

    public function update(Order $order) {
        $user = Auth::user();

        $attributes = $this->validateOrder($order);

        $order->update($attributes);
        
        return response()->json([
            'message' => 'order successfully updated',
        ]);
        
    }

    protected function validateOrder(?Order $order = null) {

        $order ??= new Order();

        return request()->validate([
            'sub_total' => $order->exists ? ['numeric'] : ['required', 'numeric'],
            'total_price' => $order->exists ? ['numeric'] : ['required', 'numeric'],
            'payment_method' => $order->exists ? '' : ['required'],
            'items' => $order->exists ? '' : ['required'],
        ]);

    }
    
}
