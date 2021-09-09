<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class SubCategory extends Model
{
    use HasFactory ,HasTranslations ,SoftDeletes;
    public $translatable = ['name'];
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')->withDefault(['name' => 'no Category']);
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
