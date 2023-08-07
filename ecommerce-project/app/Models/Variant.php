<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use DB;

class Variant extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeMaxPrice(Builder $query, $price): Builder
    {
        return $query->where('price', '<=', $price);
    }

    public function scopeAverageRating(Builder $query, ...$ratings): Builder
    {
        
        return $query->whereExists(function ($query) use($ratings) {
            $query->select(DB::raw(1))
                ->from('products')
                ->whereColumn('products.id', 'variants.product_id')
                ->whereIn('average_rating', $ratings);
        });

    }   

    public function scopeOptions(Builder $query, ...$options) {

        foreach ($options as $option) {
            $variants =  explode('/', $option);

            if(sizeof($variants) > 0) {
                $options_info[] = $variants;
            }
        }

        foreach($options_info as $option) {
            
            $query->where(function($query) use($option) {
                $query->whereIn('option1', $option)
                ->orWhereIn('option2', $option);
            });
        }
        return $query;

    }
    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class, 'order_contents', 'order', 'variant')
        ->as('content');
    }

    public function options() {
        return $this->belongsToMany(Option::class);
    }



}
