<?php

namespace App\Models;

use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Cart extends Pivot
{
    use HasFactory;
    protected $table='carts';
    protected $keyType='string';/*uuid*/
    protected $guarded = [];



    public function product()
    {
        return $this->belongsTo(Product::class,
            'product_id', 'id')->withDefault();
    }
    public function user()
    {
        return $this->belongsTo(User::class,
            'user_id', 'id')->withDefault();
    }
    protected function setKeysForSaveQuery($query)
    {
        return $query->where('id',$this->attributes['id'])
            ->where('product_id',$this->attributes['product_id']);
    }
    protected function incrementOrDecrement($column, $amount, $extra, $method)
    {
        $query =$this->newQueryWithoutRelationships();
        if (! $this->exists) {
            return $query->{$method}($column,$amount,$extra);
        }
        $this->incrementOrDecrementAttribuyeValue($column,$amount,$extra,$method);
    }

}
