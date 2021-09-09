<?php

namespace App\Models;

use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function products()
    {
        return $this->hasManyThrough(
            Product::class,/*related model*/
            User::class,/*through model*/
            'store_id',/*foreign key in through table*/
            'user_id',/*foreign key in related table*/
            'id',/*primary key in this table*/
            'id',/*primary key in through table*/
        );
    }
}
