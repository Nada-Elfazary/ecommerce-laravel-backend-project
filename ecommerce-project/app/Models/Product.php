<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\VariantResource;
use DB;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'options' => 'array'
    ];

    public function scopeMaxPrice(Builder $query, $price): Builder
    {
        return $query->selectRaw('id, title,
        average_rating')->whereExists(function ($query) use($price) {
            $query->selectRaw(DB::raw(1))
                ->from('variants')
                ->whereColumn('variants.product_id', 'products.id')
                ->where('price', '<=', $price);
        });

    }

    public function scopeAverageRating(Builder $query, ...$ratings): Builder
    {
        
        return $query->selectRaw('id, title, 
        average_rating')->whereIn('average_rating', $ratings);
      

    }   

    public function scopeOptions(Builder $query, ...$options) {

        foreach ($options as $option) {
            $variants =  explode('/', $option);

            if(sizeof($variants) > 0) {
                $options_info[] = $variants;
            }
        }

        $query->selectRaw('id, title, 
            average_rating')->whereExists(function($query) use($option, $options) {
                foreach($options as $option) {
                    $variants =  explode('/', $option);
             
                    $query->select()->from('variants')
                    ->whereColumn('variants.product_id', 'products.id')->whereExists(function($query) use($option, $variants) { 
                        $query->whereIn('option1', $variants)
                        ->orWhereIn('option2', $variants);
                    });
                }
            });
        
        return $query;

    }

    

    public function variants() {
        return $this->hasMany(Variant::class);
    }

    public function options() {
        return $this->belongsToMany(Option::class, 'product_specs')->withPivot('option_idx');
    }

    public function owner() {
        return $this->belongsToMany(User::class, 'wishlists');
    }

    public function defaultVariant($product_id) {
        $default_variant = Variant::where('product_id','=', $product_id)->orderBy('price', 'asc')->first();
        return new VariantResource($default_variant);
    }

    public function inStock($variants) {
        echo $variants;
        echo "DONEEEE";
    }

}
