<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'image',
        'name',
        'description',
        'price',
        'sale_price',
        'brands',
        'rating',
        'approve',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderDetail()
    {
        return $this->hasMany('App\Models\OrderDetail','product_id', 'id');
    }
}
