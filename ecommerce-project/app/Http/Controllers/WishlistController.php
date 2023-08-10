<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Product; 
use App\Models\User; 
use App\Http\Resources\ProductResource; 


class WishlistController extends Controller
{
    public function index() {
        $user = Auth::user();
        $favorites = $user->favorites;

        return ProductResource::collection($favorites);
    }

    public function create(Product $product) {
        $user = Auth::user();
        $message = "";
        if ($user->favorites->contains($product->id)) {
            $message = 'product is already in favorites';
        } else{
            $user->favorites()->attach($product->id);
            $message = 'product successfully added to favorites';
        }

        return response()->json([
            'message' => $message,
        ]);
    }

    public function destroy(Product $product) {
        $user = Auth::user();
        $message = "";
        if ($user->favorites->contains($product->id)) {
            $user->favorites()->detach($product->id);
            $message = 'product successfully removed from favorites';
        } else{
            $message = 'product could not be found in favorites';
        }

        return response()->json([
            'message' => $message,
        ]);

        return response()->json([
            'message' => 'product successfully removed from favorites',
        ]);
    }
}
