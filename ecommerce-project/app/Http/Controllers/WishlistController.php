<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Product; 


class WishlistController extends Controller
{
    public function index() {
        $user = Auth::user();
        $favorites = $user->favorites;

        return response()->json([
            'wishlist' => $favorites,
        ]);
    }

    public function create(Product $product) {
        $user = Auth::user();

        $user->favorites()->create([
            'product_id' => $product->id,
        ]);
  
        return response()->json([
            'message' => 'product successfully added to favorites',
        ]);
    }

    public function destroy(Product $product) {
        $product->delete();

        return response()->json([
            'message' => 'product successfully deleted from favorites',
        ]);
    }
}
