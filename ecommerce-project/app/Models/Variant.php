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

    public function scopeAverageRating(Builder $query, $rating): Builder
    {
        
        return $query->whereExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('products')
                ->where('average_rating', '=', 10);
        })->get();
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
