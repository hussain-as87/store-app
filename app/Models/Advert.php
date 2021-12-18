<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Advert extends Model
{
    use HasFactory, SearchableTrait, HasTranslations;

    protected $guarded = [];
    public $translatable = ['title', 'content'];

    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'adverts.id' => 10,
            'adverts.title' => 10,
            'adverts.content' => 10,
        ]
    ];


    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }


    public function getNameenAttribute()
    {
        return $this->getTranslation('title', 'en');
    }

    public function getNamearAttribute()
    {
        return $this->getTranslation('title', 'ar');
    }
}
