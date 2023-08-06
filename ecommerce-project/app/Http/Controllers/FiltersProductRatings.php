<?php
namespace App\Http\Controllers;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use DB;

class FiltersProductRatings implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
   
    {
        if(gettype($value) != 'array') {
            $value = array($value);
        }
        return $query->whereExists(function ($query) use($value) {
            $query->select(DB::raw(1))
                ->from('products')
                ->whereColumn('products.id', 'variants.product_id')
                ->whereIn('average_rating', $value);
        })->get();

        
        
    }
}


