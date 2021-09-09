<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;


    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_tags', 'tag_id', 'product_id',
            'id', 'id');
    }
}
