<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class OrderProduct extends Model
{
    public $fillable = ['qty', 'product_id', 'price'];

    public $timestamps = false;

    public function products()
    {
        return $this->belongsToMany(Product::class,'products');
    }

}



