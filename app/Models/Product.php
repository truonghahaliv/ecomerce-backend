<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name',  'price', 'quantity', 'quantity_sold', 'image', 'description',];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
