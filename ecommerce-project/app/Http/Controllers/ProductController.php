<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Controllers\FiltersProductOptions;
use App\Http\Controllers\FiltersProductRatings;
use App\Http\Resources\ProductResource;
use DB;
use App\Models\Variant;
use App\Models\User;
use App\Models\Product;


class ProductController extends Controller
{
    public function index() {
       // dd($product->options()->get());

        //search resource in referres in controller and defined as fields in resources folder
        
        try {
            if (sizeof($_REQUEST) == 0) {
                $products = Product::with('options')->selectRaw('id, title, 
                average_rating')->get();
            }
            else{
                $products = QueryBuilder::for(Product::class)
                    ->with(['options'])
                    ->allowedFilters([
                        AllowedFilter::scope('average_rating'),
                        AllowedFilter::scope('options'),
                        AllowedFilter::scope('max_price'),
                    ])
                    ->get();

            }

            return ProductResource::collection($products);

            /*
            return response()->json([
                'products' => $products,
            ]);*/

        } catch(\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    
}
