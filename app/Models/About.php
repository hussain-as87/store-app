<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class About extends Model
{
    use HasFactory, SearchableTrait, HasTranslations;

    protected $guarded = [];
    public $translatable = ['story', 'service'];

    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'abouts.id' => 10,
            'abouts.story' => 10,
            'abouts.service' => 10,
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
    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
