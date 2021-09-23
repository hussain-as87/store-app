<?php

namespace App\Models\Admin;


use App\Models\User;
use App\Models\Order;
use App\Models\Comment;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, HasTranslations, SoftDeletes ,SearchableTrait;


    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'products.name' => 10,
            'products.description' => 10,
        ] ,
          'joins' => [
              'categories' => ['categories.id','products.category_id'],
              'users' => ['users.id','products.category_id'],
          ],
    ];
    public $translatable = ['name', 'description'];
    protected $guarded = [];
    //const CREATED_AT = 'created_on';
    //const UPDATED_AT = 'updated_at';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')->withDefault(['name' => 'no Category']);
    }

    public function product_images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'products_tags',
            'product_id',
            'tag_id',
            'id',
            'id'
        );
    }

    public function comments()
    {
        return $this->morphMany(
            Comment::class,
            'commentable'
        );
    }

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function getNameenAttribute()
    {
        return $this->getTranslation('name', 'en');
    }

    public function getNamearAttribute()
    {
        return $this->getTranslation('name', 'ar');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products')
            ->using(OrderProduct::class);/*model of relation between orders & products */
    }

    public static function TopSales($limit)
    {
        return Product::with('user.store', 'category')->select([
            '*',
            DB::raw('(SELECT SUM(quantity) FROM order_products) AS sales')
        ])->orderBy('sales', 'DESC')->limit($limit)->get();
    }

    public function scopeHighPrice($query, $min, $max = null)
    {
        $query->where('price', '>=', $min);
        if ($max !== null) {
            $query->where('price', '<=', $max);
        }
        return $query;
    }

    /*public static function booted()
    {
        //parent::booted();
        static::addGlobalScope('ordered',function ($query){
           $query->has('orders');
        });
    }*/
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
