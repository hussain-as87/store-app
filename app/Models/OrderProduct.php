<?php

namespace App\Models;

use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderProduct extends Pivot
{
    use HasFactory;

    protected $table = 'order_products';
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class,);
    }

    public function product()
    {
        return $this->belongsTo(Product::class,);
    }

}
