<?php

namespace App\Models;

use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceDiscount extends Model
{
    use HasFactory;

    protected $gaurded = [];
    protected $fillable = ['percentage'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
