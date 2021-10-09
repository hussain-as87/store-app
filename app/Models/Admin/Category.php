<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory, SearchableTrait, HasTranslations, SoftDeletes;

    protected $guarded = [];
    public $translatable = ['name'];

    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'categories.id' => 10,
            'categories.name' => 10,
        ]
        //  ,
        //  'joins' => [
        //      'products' => ['categories.id','products.category_id'],
        //      'sub_categories' => ['categories.id','sub_categories.category_id'],
        //  ],
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
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
}
