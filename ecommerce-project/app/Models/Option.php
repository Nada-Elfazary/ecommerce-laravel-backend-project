<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Option extends Model
{
    use HasFactory;

    protected $casts = [
        'values' => 'array'
    ];

    public function products() {
        return $this->belongsToMany(Product::class, 'product_specs')
        ->as('details')->withPivot('option_idx');
    }
}
