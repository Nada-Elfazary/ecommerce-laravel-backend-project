<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\Variant;
use App\Http\Controllers\FiltersProductOptions;
use App\Http\Controllers\FiltersProductRatings;
include "FiltersProductOptions.php";
include "FiltersProductRatings.php";

class ProductController extends Controller
{
    public function index() {
        //search resource in referres in controller and defined as fields in resources folder
        if (sizeof($_REQUEST) == 0) {
            $products = 0;
        }
        
        try {
            $products = QueryBuilder::for(Variant::class)
                ->allowedFilters([
                    AllowedFilter::custom('average_rating', new FiltersProductRatings),
                    AllowedFilter::custom('options', new FiltersProductOptions),
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
