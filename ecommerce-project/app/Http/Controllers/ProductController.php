<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\Variant;
use App\Http\Controllers\FiltersProductOptions;
use App\Http\Controllers\FiltersProductRatings;

class ProductController extends Controller
{
    public function index() {
        //search resource in referres in controller and defined as fields in resources folder
        
        try {
            $products = QueryBuilder::for(Variant::class)
                ->allowedFilters([
                    AllowedFilter::scope('average_rating'),
                    AllowedFilter::scope('options'),
                    AllowedFilter::scope('max_price'),
                ])
                ->get();
        
            return response()->json([
                'products' => $products,
            ]);

        } catch(\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    
}
