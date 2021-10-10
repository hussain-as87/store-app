<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Post;
use App\Models\Order;
use App\Models\Store;
use App\Models\Comment;
use App\Models\Message;
use App\Models\Admin\Product;
use App\Models\Admin\Profile;
use App\Models\Admin\Category;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use SearchableTrait;
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'users.name' => 10,
            'users.email' => 10,
            'users.id' => 10,
        ]
        //  ,
        //  'joins' => [
        //      'products' => ['categories.id','products.category_id'],
        //      'sub_categories' => ['categories.id','sub_categories.category_id'],
        //  ],
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'facebook_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'roles_name' => 'array',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class)->withDefault();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function routeNotificationForMail($driver, $notification = null)
    {
        return $this->email;
    }

    public function routeNotificationForNexmo($driver, $notification = null)
    {
        return $this->profile->phone;
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'receiver');
    }
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender');
    }
    /* public function hasPermission($name)
    {
        DB::table('users_permissions')
            ->where('user_id', auth()->id())
            ->where('permission', $name)
            ->count();
    } */

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function favorites()
    {
        return $this->hasMany(favoriteProduct::class);
    }
}
