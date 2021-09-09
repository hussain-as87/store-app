<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name'];
    protected $guarded = [];

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
}
