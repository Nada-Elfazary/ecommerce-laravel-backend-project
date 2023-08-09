<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        
        return $query->selectRaw('id, product_id, title, skuid, 
        option1 as first_property, option2 as second_property,
        price, stock, is_in_stock')->whereExists(function ($query) use($ratings) {
            $query->selectRaw(DB::raw(1))
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
            
            $query->selectRaw('id, product_id, title, skuid, 
            option1 as first_property, option2 as second_property,
            price, stock, is_in_stock')->where(function($query) use($option) {
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
        return $this->belongsToMany(Order::class, 'order_contents')
        ->as('content');
    }

    public function inStock($stock) {
        if($stock == 0) {
            return False;
        } else{
            return True;
        }
    }



}
