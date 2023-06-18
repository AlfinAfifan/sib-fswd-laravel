<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'detail_orders';

    protected $fillable = [
        'product_id',
        'order_id',
        'total',
        'total_price',
    ];

    public function products()
	{
	    return $this->belongsTo('App\Models\Product','product_id', 'id');
	}

	public function order()
	{
	    return $this->belongsTo(Order::class);
	}
}
