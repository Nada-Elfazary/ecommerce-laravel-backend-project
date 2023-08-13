<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function creator() {
        return $this->belongsTo(User::class);
    }

    public function variants() {
        return $this->belongsToMany(Variant::class, 'order_contents')->as('content')
        ->withPivot('quantity');
    }

}
