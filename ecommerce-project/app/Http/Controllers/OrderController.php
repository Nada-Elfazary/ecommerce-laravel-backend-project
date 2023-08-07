<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use DB;

class OrderController extends Controller
{
    public function index() {
        $user = Auth::user();

        $orders = $user->orders;
        
        return response()->json([
            'orders' => $orders
        ]);
        
    }
    
}
