<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'options' => 'array'
    ];

    public function scopeOptions(Builder $query, $options): Builder
    {
        return $query->where('option1', '=', $options[0])
        ->where('option2', '=', $options[1]);
    }

   


    public function variants() {
        return $this->hasMany(Variant::class);
    }

    public function options() {
        return $this->belongsToMany(Option::class, 'product_specs', 'product', 'option')
        ->as('details')->withPivot('option_idx');
    }
}
