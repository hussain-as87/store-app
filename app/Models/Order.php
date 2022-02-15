<?php

namespace App\Models;

use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')
            ->using(OrderProduct::class)/*model of relation between orders & products */
            ->withPivot(['price', 'quantity'])->as('details');
    }

    /*i can put relation of order_product directory*/

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public static function SaleInMonth()
    {
        return DB::select("SELECT monthname(o.created_at) AS month,
                                 year(o.created_at) AS year,
                                 COUNT( DISTINCT o.id ) AS count,
                                 SUM(p.quantity * p.price) AS total,
                                 SUM(p.product_id) AS products
                                    from orders as o INNER JOIN order_products as p ON p.order_id = o.id
                                    GROUP BY month , year
                                    HAVING SUM(p.quantity * p.price) > 200
                                    ORDER BY total ASC");
    }
}
